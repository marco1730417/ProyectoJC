<?php

namespace App\Http\Controllers;
use  App\Http\Requests\Producto\StoreRequest;
use App\Http\Requests\Producto\UpdateRequest;
use App\Http\Controllers\api\ApiResponseController;
use App\Models\Producto;

use Illuminate\Http\Request;

class ProductoApiController extends ApiResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllProductos() 
    {
        $producto_info = Producto::all();
        return $this->successResponse($producto_info);
    }
    public function createNewProductoV1(Request $request){
        $data = request()->all(); 



        $new_producto = new Producto;
        $new_producto->nombre =$data['nombre'];
        $new_producto->descripcion =  $data['descripcion'];
        $new_producto->unidades =  $data['unidades'];
        $new_producto->iva =  $data['iva'];
        $new_producto->PrecioVenta1 =  $data['PrecioVenta1'];
        $new_producto->PrecioVenta2 =  $data['PrecioVenta2'];
        $new_producto->PrecioVenta3 =  $data['PrecioVenta3'];
        $new_producto->preciocompra =  $data['preciocompra'];
        $new_producto->Utilidad =  $data['PrecioVenta1'] - $data['preciocompra'];
        $new_producto->save();

        if (!$new_producto) return $this->errorResponse(500);

        return $this->successResponse(200);
    }

    public function createNewProducto(Request $request){
        $data = request()->all(); 

        $new_producto = new Producto;
        $new_producto->nombre =$data['nombre'];
        $new_producto->descripcion =  $data['descripcion'];
        $new_producto->unidades =  $data['unidades'];
        $new_producto->iva =  $data['iva'];
        $new_producto->PrecioVenta1 =  $data['PrecioVenta1'];
        $new_producto->PrecioVenta2 =  $data['PrecioVenta2'];
        $new_producto->PrecioVenta3 =  $data['PrecioVenta3'];
        $new_producto->preciocompra =  $data['preciocompra'];
        $new_producto->Utilidad =  $data['PrecioVenta1'] - $data['preciocompra'];
        $new_producto->rollos =  $data['rollos'];
        $new_producto->uniPrecioVenta1 =  $data['uniPrecioVenta1'];
        $new_producto->uniPrecioVenta2 =  $data['uniPrecioVenta2'];
        $new_producto->uniPrecioVenta3 =  $data['uniPrecioVenta3'];
        $new_producto->metrosrollo =  $data['metrosrollo'];
      
        $new_producto->save();

        if (!$new_producto) return $this->errorResponse(500);

        return $this->successResponse(200);
    }
    public function UpdateProducto(Request $request){
     
        $data = request()->all(); 
        $data= $data['informacionedicionproducto'];
      $nombre = $data['nombre'];
        $descripcion = $data['descripcion'];
        $iva = $data['iva'];
        $unidades = $data['unidades'];
        $id = $data['id'];
        $PrecioVenta1 = $data['PrecioVenta1'];
        $PrecioVenta2 = $data['PrecioVenta2'];
        $PrecioVenta3 = $data['PrecioVenta3'];
        $uniPrecioVenta1 = $data['uniPrecioVenta1'];
        $uniPrecioVenta2 = $data['uniPrecioVenta2'];
        $uniPrecioVenta3 = $data['uniPrecioVenta3'];
        $rollos = $data['rollos'];
        $metrosrollo=$data['metrosrollo'];
       
        /* $preciocompra = $data['preciocompra'];
         */
        
   

        $producto_update = Producto::findOrFail($id);
        $producto_update->nombre = $nombre;
        $producto_update->descripcion = $descripcion;
        $producto_update->iva = $iva;
        $producto_update->unidades = $unidades;
        $producto_update->PrecioVenta1 = $PrecioVenta1;
        $producto_update->PrecioVenta2 = $PrecioVenta2;
        $producto_update->PrecioVenta3 = $PrecioVenta3;
        $producto_update->uniPrecioVenta1 = $uniPrecioVenta1;
        $producto_update->uniPrecioVenta2 = $uniPrecioVenta2;
        $producto_update->uniPrecioVenta3 = $uniPrecioVenta3;
        $producto_update->rollos = $rollos;
        $producto_update->metrosrollo = $metrosrollo;
      
        
        /* $producto_update->preciocompra = $preciocompra;
         */
       /*  $producto_update->Utilidad = $PrecioVenta1-$preciocompra;
         */
        $producto_update->update(); 


        if (!$producto_update) return $this->errorResponse(500);
        return $this->successResponse(200);
    }
    public function UpdateProductoBackup(Request $request){
     
        $data = request()->all(); 
        $data= $data['informacionedicionproducto'];
      $nombre = $data['nombre'];
        $descripcion = $data['descripcion'];
        $iva = $data['iva'];
        $unidades = $data['unidades'];
        $id = $data['id'];
        $PrecioVenta1 = $data['PrecioVenta1'];
        $PrecioVenta2 = $data['PrecioVenta2'];
        $PrecioVenta3 = $data['PrecioVenta3'];
        
        $preciocompra = $data['preciocompra'];
        
        
   

        $producto_update = Producto::findOrFail($id);
        $producto_update->nombre = $nombre;
        $producto_update->descripcion = $descripcion;
        $producto_update->iva = $iva;
        $producto_update->unidades = $unidades;
        $producto_update->PrecioVenta1 = $PrecioVenta1;
        $producto_update->PrecioVenta2 = $PrecioVenta2;
        $producto_update->PrecioVenta3 = $PrecioVenta3;
        
        $producto_update->preciocompra = $preciocompra;
        
        $producto_update->Utilidad = $PrecioVenta1-$preciocompra;
        
        $producto_update->update(); 


        if (!$producto_update) return $this->errorResponse(500);
        return $this->successResponse(200);
    }
    

    public function deleteProducto($id)
    {        
        $producto_delete = Producto::findOrFail($id);
        $producto_delete->delete();
        if (!$producto_delete) return $this->errorResponse(500);
        return $this->successResponse(200);
    }

}
