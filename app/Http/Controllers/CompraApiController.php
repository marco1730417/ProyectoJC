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
use PDF
 ;

class CompraApiController extends ApiResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
/* 
     api que trae todo el datalle de compras incluido los productos */

    public function getInformacionCompras()
    {
        $detalle_compras = Compras:: select('compras.fecha','compras.total','compras.valoriva','compras.comprobante','detalle_compras.cantidad','detalle_compras.precio','detalle_compras.proId',
        'productos.nombre','productos.descripcion','proveedores.nombre','proveedores.ruc','proveedores.telefono','proveedores.email'
        ) 
        ->leftJoin('detalle_compras', 'compras.id', '=', 'detalle_compras.comId')
            ->leftJoin('proveedores', 'compras.prvId', '=', 'proveedores.id')
            ->leftJoin('productos', 'detalle_compras.proId', '=', 'productos.id')->get();

        return $this->successResponse($detalle_compras);
    }
/* 
    api que trae las compras con sus detalles basicos */
    public function getCompras()
    {
        $compras = Compras:: select('compras.fecha','compras.total','compras.valoriva','compras.comprobante'
        ,'proveedores.nombre','proveedores.ruc','proveedores.telefono','proveedores.email'
        ) 

            ->leftJoin('proveedores', 'compras.prvId', '=', 'proveedores.id')->get();
       
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


        $update_compra =  Compras::findOrFail($data['comId']) ;
        $update_compra->fecha =  $data['fecha'];;
        $update_compra->prvId =  $data['prvId'];;
        $update_compra->total =  $data['total'];;
        $update_compra->total =  $data['total'];;
        $update_compra->comprobante =  $data['comprobante'];;
        $update_compra->update();

        if (!$update_compra) return $this->errorResponse(500);

        return $this->successResponse(200);
    }


    public function addProductosCompra(Request $request)
    {
       

        $data = request()->all();
        $new_detalle_compras = new DetalleCompras;
        $new_detalle_compras->comId =  $data['comId'];
        $new_detalle_compras->proId =  $data['proId'];
        $new_detalle_compras->cantidad =  $data['cantidad'];
        $new_detalle_compras->precio =  $data['precio'];
        $new_detalle_compras->save();

        $update_stock =  Producto::findOrFail($data['proId']) ;
        $update_stock->unidades =  $new_detalle_compras->cantidad+ $update_stock->unidades;
        $update_stock->update();

      

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
            'productos.unidades',
            'productos.nombre as proNombre',
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


    

}



