<?php

namespace App\Http\Controllers;

use  App\Http\Requests\Producto\StoreRequest;
use App\Http\Requests\Producto\UpdateRequest;
use App\Http\Controllers\api\ApiResponseController;
use App\Models\Cliente;
use App\Models\Venta;
use App\Models\Pago;
use Illuminate\Support\Facades\DB;
use App\Models\DetalleVenta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Pagination\PaginationState;
use Illuminate\Support\Facades\Config;
use PDF;

class PagoApiController extends ApiResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function PagosPendientes()
    {
        $pagos = Pago::select(
            'pagos.tipo',
            'pagos.total',
            'pagos.pago',
            'ventas.fecha as venfecha',
            'ventas.id',
            'pagos.abono',
            'pagos.fechamaxima',
            'pagos.saldo',
            'pagos.fecha as pagofecha',
            'pagos.venId',
            'pagos.id as pagId',
            'pagos.cliId','clientes.nombre','clientes.telefono','clientes.ruc'
        )
            ->leftJoin('ventas', 'pagos.venId', '=', 'ventas.id')
            ->leftJoin('clientes', 'pagos.cliId', '=', 'clientes.id')
          //  ->whereDate('pagos.fechamaxima', '=', Carbon::today()->toDateString())
          ->where('pagos.estado',0)  
          ->orderBy('pagos.fechamaxima')
          ->get();
  
        return $this->successResponse($pagos);
    }

    public function deletePago($id)
    {        
        $pago = Pago::findOrFail($id);
        $pago->delete();
        if (!$pago) return $this->errorResponse(500);
        return $this->successResponse(200);
    }

    public function cambioestadoPago($id)
    {        
        $pago = Pago::findOrFail($id);
        $pago->estado = 1;
        $pago->update();

        if (!$pago) return $this->errorResponse(500);
        return $this->successResponse(200);
    }




}
