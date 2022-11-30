<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Producto;
use Illuminate\Http\Request;
use  App\Http\Requests\Producto\StoreRequest;
use App\Http\Requests\Producto\UpdateRequest;
use App\Exports\ProductoExport;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('productos.index');
    }
    public function export() 
    {
        $carbon = new \Carbon\Carbon();
        $fecha = $carbon->now();
    return Excel::download(new ProductoExport, 'Reporte Productos '.$fecha.'.xlsx');
    }
   
}
