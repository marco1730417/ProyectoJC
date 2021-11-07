<?php

namespace App\Http\Controllers;
use  App\Http\Requests\Cliente\StoreRequest;
use App\Http\Requests\Cliente\UpdateRequest;
use App\Http\Controllers\api\ApiResponseController;
use App\Models\Cliente;

use Illuminate\Http\Request;

class ClienteApiController extends ApiResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllClientes() 
    {
        $cliente_info = Cliente::all();
        return $this->successResponse($cliente_info);
    }
    public function createNewClient(Request $request){
        $data = request()->all(); 



        $new_cliente = new Cliente;
        $new_cliente->nombre =$data['nombre'];
        $new_cliente->email = $data['email'];
        $new_cliente->telefono =  $data['telefono'];
        $new_cliente->ruc =  $data['ruc'];
        $new_cliente->direccion =  $data['direccion'];
        $new_cliente->save();

        if (!$new_cliente) return $this->errorResponse(500);

        return $this->successResponse(200);
    }

    public function UpdateCliente(Request $request){
     
        $data = request()->all(); 
        $data= $data['informacionedicioncliente'];
     
        $nombre = $data['nombre'];
        $email = $data['email'];
        $telefono = $data['telefono'];
        $direccion = $data['direccion'];
        $ruc = $data['ruc'];
        $id = $data['id'];
        
   

        $cliente_update = Cliente::findOrFail($id);
        $cliente_update->nombre = $nombre;
        $cliente_update->email = $email;
        $cliente_update->telefono = $telefono;
        $cliente_update->direccion = $direccion;
        $cliente_update->ruc = $ruc;
        $cliente_update->update(); 


        if (!$cliente_update) return $this->errorResponse(500);
        return $this->successResponse(200);
    }
    public function deleteCliente($id)
    {        
        $cliente_delete = Cliente::findOrFail($id);
        $cliente_delete->delete();
        if (!$cliente_delete) return $this->errorResponse(500);
        return $this->successResponse(200);
    }

}
