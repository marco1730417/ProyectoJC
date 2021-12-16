<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;

use Illuminate\Http\Request;
use  App\Http\Requests\Producto\StoreRequest;
use App\Http\Requests\Producto\UpdateRequest;


class ReportesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('reporte.index');
    }
    public function reporteventas()
    {
        return view ('reporte.reporteventapdf');
    }
    public function reporteclientepdf()
    {
        return view ('reporte.reporteclientepdf');
    }
    public function reportecliente()
    {
        return view ('reporte.reportecliente');
    }
 
   
}
