<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\ApiResponseController;
use App\Models\Compras;
use App\Models\DetalleCompras;
use App\Models\Proveedores;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Pagination\PaginationState;
use Illuminate\Support\Facades\Config;
use PDF;

class CompraApiController extends ApiResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /* 
     api que trae todo el datalle de compras incluido los productos */

    public function getInformacionHeaderCompras($id)
    {
        $detalle_compras = Compras::findOrFail($id);


        $proveedor_actual = Proveedores::findOrFail($detalle_compras->prvId);

        $informacion_header = [
            'detalle_compra' => $detalle_compras,
            'proveedor' => $proveedor_actual
        ];


        return $this->successResponse($informacion_header);
    }
    /* 
    api que trae las compras con sus detalles basicos */
    public function getCompras()
    {
        $compras = Compras::select(
            'compras.id',
            'compras.fecha',
            'compras.total',
            'compras.valoriva',
            'compras.comprobante',
            'proveedores.nombre',
            'proveedores.ruc',
            'proveedores.telefono',
            'proveedores.email'
        )

            ->leftJoin('proveedores', 'compras.prvId', '=', 'proveedores.id')
            ->orderBy('compras.fecha', 'desc')

            ->get();

        return $this->successResponse($compras);
    }

    /* 
    crear una compra */
    public function createNuevaCompra()
    {

        $new_compra = new Compras;

        $new_compra->save();

        if (!$new_compra) return $this->errorResponse(500);

        return $this->successResponse($new_compra->id);
    }
    public function updatecompra(Request $request)
    {

        $data = request()->all();


        $update_compra =  Compras::findOrFail($data['comId']);
        $update_compra->fecha =  $data['fecha'];;
        $update_compra->prvId =  $data['prvId'];;
        $update_compra->total =  $data['total'];;
        $update_compra->total =  $data['total'];;
        $update_compra->comprobante =  $data['comprobante'];

        $update_compra->subtotal =  $data['subtotal'];
        $update_compra->subtotalcero =  $data['subtotalcero'];
        $update_compra->subtotaliva =  $data['subtotaldoce'];
        $update_compra->valoriva =  $data['valoriva'];
        $update_compra->descuento =  $data['descuento'];



        $update_compra->update();

        if (!$update_compra) return $this->errorResponse(500);

        return $this->successResponse(200);
    }


    public function addProductosCompra(Request $request)
    {


        $data = request()->all();

       // return $data;

        $tipo =  $data['tipo'];
        if ($tipo === 'rll' || $tipo==='cj') {

            $new_detalle_compras = new DetalleCompras;
            $new_detalle_compras->comId =  $data['comId'];
            $new_detalle_compras->proId =  $data['proId'];
            $new_detalle_compras->cantidad =  $data['cantidad'] * $data['rollos'];
            $new_detalle_compras->precio =  $data['precio'];
            $new_detalle_compras->tipo =  $data['tipo'];
            $new_detalle_compras->rollos =  $data['rollos'];
        
            $new_detalle_compras->save();

            $update_stock =  Producto::findOrFail($data['proId']);
            $update_stock->unidades =  $new_detalle_compras->cantidad + $update_stock->unidades;
            $update_stock->metrosrollo = $data['cantidad'];
            
            $update_stock->update();
        }

        if ($tipo === 'mt'|| $tipo==='u') {

            $new_detalle_compras = new DetalleCompras;
            $new_detalle_compras->comId =  $data['comId'];
            $new_detalle_compras->proId =  $data['proId'];
            $new_detalle_compras->cantidad =  $data['cantidad'];
            $new_detalle_compras->precio =  $data['precio'];
            $new_detalle_compras->tipo =  $data['tipo'];
            $new_detalle_compras->rollos =  $data['rollos'];

            $new_detalle_compras->save();

            $update_stock =  Producto::findOrFail($data['proId']);
            $update_stock->unidades =  $new_detalle_compras->cantidad + $update_stock->unidades;
            $update_stock->update();
        }

        if (!$new_detalle_compras) return $this->errorResponse(500);

        return $this->successResponse(200);
    }


    public function getInformacionCompra($comId)
    {
        $detalle_compra = DetalleCompras::select(
            'detalle_compras.proId',
            'detalle_compras.id',
            'detalle_compras.cantidad',
            'detalle_compras.precio',
            'detalle_compras.rollos',

            'detalle_compras.tipo',

            'productos.unidades',
            'productos.nombre as proNombre',
            'productos.descripcion as proDescripcion',


            'compras.fecha',
            'compras.comprobante',
            'proveedores.nombre'




        )
            ->leftJoin('compras', 'detalle_compras.comId', '=', 'compras.id')
            ->leftJoin('productos', 'detalle_compras.proId', '=', 'productos.id')
            ->leftJoin('proveedores', 'compras.prvId', '=', 'proveedores.id')

            ->where('compras.id', $comId)->get();
        return $this->successResponse($detalle_compra);
    }

    public function deleteCompra($comId)
    {
        $infodetalle=  DetalleCompras::where('comId', $comId)->get();

        $collection = collect($infodetalle);
        $collection->each(function ($item, $key) {
        $update_producto = Producto::findOrFail($item->proId);
        $update_producto->unidades = $update_producto->unidades - $item->cantidad;
        $update_producto->update();
        DetalleCompras::where('comId', $item->comId)->delete();

        });
        Compras::where('id', $comId)->delete();
         if (!$collection) return $this->errorResponse(500); 
        return $this->successResponse(200);
    }
    public function deleteDetalleCompra($id)
    {
        $infodetalle = DetalleCompras::findOrFail($id);
        $update_producto = Producto::findOrFail($infodetalle->proId);
        $validacion_stock=$update_producto->unidades - $infodetalle->cantidad;
        if($validacion_stock>0)
        $update_producto->unidades = $update_producto->unidades - $infodetalle->cantidad;
        else 
        $update_producto->unidades = 0;

        $update_producto->update();
 

        $detalle_delete = DetalleCompras::findOrFail($id);
        $detalle_delete->delete();
        if (!$detalle_delete) return $this->errorResponse(500); 
        return $this->successResponse(200);
    }





    public function totalDashboardCompras()
    {


      
        $total_compras= Compras::sum('total');
        $max_compra= Compras::max('total');

     // $proveedor="XXX";
      $proveedor = Compras::select(
        'prvId',
        'proveedores.nombre',
        DB::raw("(SELECT count(compras.prvId) FROM compras where compras.prvId = proveedores.id 
    ) AS total"),
    )
        ->leftJoin('proveedores', 'compras.prvId', '=', 'proveedores.id')
        ->orderBy('total','desc')->take(1)->get();

   
     

        $info_dashboard = [
            'total_compras' => $total_compras,
            'proveedor' =>     $proveedor,
            'max_compra' => $max_compra,
            


        ];


        return $this->successResponse($info_dashboard);
    }

    public function updateDetalleCompra(Request $request)
    {

        $data = request()->all();
      //  return $data['infoproducto']['id'];

         $update_detalle_compra = DetalleCompras::findOrFail($data['infoproducto']['id']);
        $update_detalle_compra->precio = $data['infoproducto']['precio'];
        $update_detalle_compra->update();
        if (!$update_detalle_compra) return $this->errorResponse(500);
        return $this->successResponse(200);
    }











}
