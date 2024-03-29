<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;

use Illuminate\Http\Request;
use  App\Http\Requests\Producto\StoreRequest;
use App\Http\Requests\Producto\UpdateRequest;


class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('venta.index');
    }
    public function nuevaventa()
    {
        return view ('venta.nuevaventa');
    }
    public function editventa($id)
    {
        $id=2;
        
        return view('venta.editventa', ["venId" => $id]);
    }
    public function ventapdf()
    {
        return view ('venta.ventapdf');
    }

   
}
