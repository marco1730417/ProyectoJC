<?php

namespace App\Http\Controllers;

use  App\Http\Requests\Producto\StoreRequest;
use App\Http\Requests\Producto\UpdateRequest;
use App\Http\Controllers\api\ApiResponseController;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;
use App\Models\DetalleVenta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use PDF
 ;

class VentaApiController extends ApiResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function createNuevaVenta()
    {
        $carbon = new \Carbon\Carbon();
        $fecha = $carbon->now();

        $new_venta = new Venta;
        $new_venta->fecha = $fecha;
        $new_venta->save();

        if (!$new_venta) return $this->errorResponse(500);

        return $this->successResponse($new_venta->id);
    }

    public function createVenta(Request $request)
    {
        $carbon = new \Carbon\Carbon();
        $fecha = $carbon->now();

        $data = request()->all();


        $new_venta = new Venta;
        $new_venta->fecha = $fecha;
        $new_venta->observacion = "Ninguna";
        $new_venta->metodopago =  $data['metodopago'];
        $new_venta->cliId =  $data['cliId'];;

        $new_venta->save();

        if (!$new_venta) return $this->errorResponse(500);

        return $this->successResponse($new_venta->id);
    }

    public function createDetalleVenta(Request $request)
    {

        $data = request()->all();

        $metrosrollo = $data['metrosrollo']; // cantidad de metros totales cuando se venda por rollo

        $precioUnitarioOpcion = $data['precioUnitario'];
        $proId = $data['proId'];
        $infoproducto = Producto::findOrFail($proId);
        if ($precioUnitarioOpcion == 1) {
            $valorPrecio = $infoproducto->PrecioVenta1;
            $metrostotales = $data['cantidad'];
        }

        if ($precioUnitarioOpcion == 2) {
            $valorPrecio = $infoproducto->PrecioVenta2;
            $metrostotales = $metrosrollo*$data['cantidad'];
        }

        if ($precioUnitarioOpcion == 3) {
            $valorPrecio = $infoproducto->PrecioVenta3;
            $metrostotales = $data['cantidad'];
        }

        $new_detalle = new DetalleVenta();
        $new_detalle->cantidad = $data['cantidad'];
        $new_detalle->precioUnitario = $valorPrecio;
        $new_detalle->proId =  $data['proId'];
        $new_detalle->venId =  $data['venId'];
        $new_detalle->metrostotales =  $metrostotales;
        $new_detalle->save();

if($new_detalle){
    $actualizar_cantidad_producto= Producto::findOrFail($proId);
    $actualizar_cantidad_producto->unidades = $actualizar_cantidad_producto->unidades - $metrostotales;
    $actualizar_cantidad_producto->update(); 
}

        if (!$new_detalle) return $this->errorResponse(500);

        return $this->successResponse(200);
    }

    public function getInformacionVenta($venId)
    {
        $detalle_venta = DetalleVenta::select(
            'detalle_ventas.cantidad',
            'detalle_ventas.id',
            
            'detalle_ventas.precioUnitario',
            'productos.nombre',
            'productos.descripcion',
            db::raw('detalle_ventas.cantidad*detalle_ventas.precioUnitario as subTotal'),

        )
            ->leftJoin('ventas', 'detalle_ventas.id', '=', 'ventas.id')
            ->leftJoin('productos', 'detalle_ventas.proId', '=', 'productos.id')
            ->leftJoin('clientes', 'ventas.cliId', '=', 'clientes.id')

            ->where('venId', $venId)->get();
        return $this->successResponse($detalle_venta);
    }
    public function deleteDetalleVenta($id)
    {        
        $infodetalle=DetalleVenta::findOrFail($id);
        $update_producto= Producto::findOrFail($infodetalle->proId);
        $update_producto->unidades = $update_producto->unidades + $infodetalle->cantidad ;
        $update_producto->update(); 

        $detalle_delete = DetalleVenta::findOrFail($id);
        $detalle_delete->delete();
        if (!$detalle_delete) return $this->errorResponse(500);
        return $this->successResponse(200);
    }

    public function totalesVenta($venId)
    {

      
        $parciales = DetalleVenta::queryVentaParcial($venId)->get();
        $subtotal = $parciales->sum('parcial');
        $iva = 12;
        $valor_iva = $subtotal*$iva/100;
        $total = $subtotal+$valor_iva;

        $totales_venta = [
                                'subtotal' => $subtotal,
                                'iva' =>     round($iva),
                                'valorIva' => $valor_iva,
                                'total' => $total
                              ];

        //return $this->successResponse($totales_cotizacion);
          
        $total_venta=collect($totales_venta);
        return $total_venta ;
    }

    public function detalleGeneralVenta($venId)
    {

      
        $info_venta= Venta :: select ('ventas.id','ventas.fecha','clientes.nombre','clientes.ruc','clientes.direccion','clientes.telefono','ventas.metodopago')
        ->leftJoin('clientes', 'ventas.cliId', '=', 'clientes.id')
        ->where('ventas.id', $venId)->get();;
        return $this->successResponse($info_venta);
    }


    public function downloadVenta($venId)
    {
 
        $detalle_venta = DetalleVenta::select(
            'detalle_ventas.cantidad',
            'detalle_ventas.id',
            'detalle_ventas.precioUnitario',
            'productos.nombre',
            'productos.descripcion',
            db::raw('detalle_ventas.cantidad*detalle_ventas.precioUnitario as subTotal'),

        )
            ->leftJoin('ventas', 'detalle_ventas.id', '=', 'ventas.id')
            ->leftJoin('productos', 'detalle_ventas.proId', '=', 'productos.id')
            ->leftJoin('clientes', 'ventas.cliId', '=', 'clientes.id')
            ->where('venId', $venId)->get();

            $parciales = DetalleVenta::queryVentaParcial($venId)->get();
            $subtotal = $parciales->sum('parcial');
            $iva = 12;
            $valor_iva = $subtotal*$iva/100;
            $total = $subtotal+$valor_iva;
    
            $totales_venta = [
                                    'subtotal' => $subtotal,
                                    'iva' =>     round($iva),
                                    'valorIva' => $valor_iva,
                                    'total' => $total
                                  ];
    
            //return $this->successResponse($totales_cotizacion);
              
            $total_venta=collect($totales_venta);


            $info_venta= Venta :: select ('ventas.id','ventas.fecha','clientes.nombre','clientes.ruc','clientes.direccion','clientes.telefono','ventas.metodopago')
            ->leftJoin('clientes', 'ventas.cliId', '=', 'clientes.id')
            ->where('ventas.id', $venId)->get();

     
 
      //  $pdf = PDF::loadView('venta.ventapdf', $data);
        $pdf = PDF::loadView('venta.ventapdf',  ["detalle_venta" => $detalle_venta, "total_venta" => $total_venta, "info_venta"=> $info_venta ],['format' => 'A4']);
    
        return $pdf->download('venta.pdf'); 
      
      
    }



    
    public function detalleVenta()
    {

      
        $info_venta= Venta :: select ('ventas.id','ventas.fecha','clientes.nombre','clientes.ruc','clientes.direccion','clientes.telefono','ventas.metodopago')
        ->leftJoin('clientes', 'ventas.cliId', '=', 'clientes.id')->get();
        return $this->successResponse($info_venta);
    }

    
    }



