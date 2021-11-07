<?php

namespace App\Http\Controllers;
use  App\Http\Requests\Producto\StoreRequest;
use App\Http\Requests\Producto\UpdateRequest;
use App\Http\Controllers\api\ApiResponseController;
use App\Models\Venta;
use App\Models\DetalleVenta;


use Illuminate\Http\Request;

class VentaApiController extends ApiResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createVenta(Request $request) 
    {
        $carbon = new \Carbon\Carbon();
        $fecha = $carbon->now();

        $data = request()->all(); 

        
        $new_venta = new Venta;
        $new_venta->fecha =$fecha;
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

        
        $new_detalle = new DetalleVenta();
        $new_detalle->cantidad =$data['cantidad'];;
        $new_detalle->precioUnitario = "precioUnitario";
        $new_detalle->proId =  $data['proId'];
        $new_detalle->venId =  $data['venId'];;
        
        $new_detalle->save();

        if (!$new_detalle) return $this->errorResponse(500);

        return $this->successResponse(200);
    }


  

}
