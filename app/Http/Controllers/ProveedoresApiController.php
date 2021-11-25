<?php

namespace App\Http\Controllers;
use App\Http\Controllers\api\ApiResponseController;
use App\Models\Proveedores;

use Illuminate\Http\Request;

class ProveedoresApiController extends ApiResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllProveedores() 
    {
        $cliente_info = Proveedores::all();
        return $this->successResponse($cliente_info);
    }
    public function createNewProveedor(Request $request){
        $data = request()->all(); 



        $new_cliente = new Proveedores;
        $new_cliente->nombre =$data['nombre'];
        $new_cliente->email = $data['email'];
        $new_cliente->telefono =  $data['telefono'];
        $new_cliente->ruc =  $data['ruc'];
        $new_cliente->direccion =  $data['direccion'];
        $new_cliente->save();

        if (!$new_cliente) return $this->errorResponse(500);

        return $this->successResponse(200);
    }

    public function UpdateProveedor(Request $request){
     
        $data = request()->all(); 
        $data= $data['informacionedicionproveedor'];
     
        $nombre = $data['nombre'];
        $email = $data['email'];
        $telefono = $data['telefono'];
        $direccion = $data['direccion'];
        $ruc = $data['ruc'];
        $id = $data['id'];
        
   

        $cliente_update = Proveedores::findOrFail($id);
        $cliente_update->nombre = $nombre;
        $cliente_update->email = $email;
        $cliente_update->telefono = $telefono;
        $cliente_update->direccion = $direccion;
        $cliente_update->ruc = $ruc;
        $cliente_update->update(); 


        if (!$cliente_update) return $this->errorResponse(500);
        return $this->successResponse(200);
    }
    public function deleteProveedor($id)
    {        
        $cliente_delete = Proveedores::findOrFail($id);
        $cliente_delete->delete();
        if (!$cliente_delete) return $this->errorResponse(500);
        return $this->successResponse(200);
    }

}
