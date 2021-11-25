<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\ApiResponseController;
use App\Models\Compras;
use App\Models\DetalleCompras;
use App\Models\Proveedores;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use App\Models\Venta;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Pagination\PaginationState;
use Illuminate\Support\Facades\Config;
use PDF
 ;

class ReportesApiController extends ApiResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function reporteVentas($fechadesde, $fechahasta)
    {
    
        $start_date = Carbon::parse($fechadesde)
        ->toDateTimeString();
        $end_date = Carbon::parse($fechahasta)
        ->toDateTimeString();
        $info_venta= Venta :: select ('ventas.id','pagos.tipo','pagos.total','ventas.fecha','ventas.observacion',
        'clientes.nombre','clientes.ruc','clientes.direccion','clientes.telefono',
        DB::raw("(SELECT sum(detalle_ventas.cantidad*detalle_ventas.precioUnitario) FROM detalle_ventas
        WHERE ventas.id=detalle_ventas.venId
        ) AS total"),
        )
      ->whereBetween(DB::raw('DATE(ventas.fecha)'), [$start_date, $end_date])
       ->leftJoin('clientes', 'ventas.cliId', '=', 'clientes.id')
        ->leftJoin('pagos', 'ventas.id', '=', 'pagos.venId')
        ->get();



    
      
        return $this->successResponse($info_venta);
    }
     

}



