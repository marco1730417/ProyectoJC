<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;

use Illuminate\Http\Request;
use  App\Http\Requests\Producto\StoreRequest;
use App\Http\Requests\Producto\UpdateRequest;


class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('compra.index');
    }
    public function editcompra($id)
    {
        $id=2;
        
        return view('compra.editcompra', ["comId" => $id]);
    }
   
}
