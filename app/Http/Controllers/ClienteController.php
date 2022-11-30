<?php

namespace App\Http\Controllers;
use  App\Http\Requests\Cliente\StoreRequest;
use App\Http\Requests\Cliente\UpdateRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Cliente;
use App\Exports\ClienteExport;

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

        $clientes = Cliente::get();
        return view ('clientes.index',compact('clientes'));
    }

    public function export() 
    {
        $carbon = new \Carbon\Carbon();
        $fecha = $carbon->now();
    return Excel::download(new ClienteExport, 'Reporte Clientes '.$fecha.'.xlsx');
    }

}
