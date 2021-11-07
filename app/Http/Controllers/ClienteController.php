<?php

namespace App\Http\Controllers;
use  App\Http\Requests\Cliente\StoreRequest;
use App\Http\Requests\Cliente\UpdateRequest;

use App\Models\Cliente;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $clientes = Cliente::get();
        return view ('clientes.index',compact('clientes'));
    }


}
