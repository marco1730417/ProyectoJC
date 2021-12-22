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
            'ventas.fecha',
            'pagos.abono',
            'pagos.fechamaxima',
            'pagos.saldo',
            'pagos.fecha',
            'pagos.venId',
            'pagos.cliId','clientes.nombre','clientes.telefono','clientes.ruc'
        )
            ->leftJoin('ventas', 'pagos.venId', '=', 'ventas.id')
            ->leftJoin('clientes', 'pagos.cliId', '=', 'clientes.id')
            ->whereDate('pagos.fechamaxima', '=', Carbon::today()->toDateString())
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




}
