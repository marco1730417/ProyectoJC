<?php

namespace App\Http\Controllers;
use  App\Http\Requests\Cliente\StoreRequest;
use App\Http\Requests\Cliente\UpdateRequest;

use App\Models\Proveedores;

use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $proveedores = Proveedores::get();
        return view ('proveedores.index',compact('proveedores'));
    }


}
