<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\ApiResponseController;
use App\Models\Compras;
use App\Models\DetalleCompras;
use App\Models\DetalleVenta;
use App\Models\Pago;
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

        $info_venta= Venta :: select ('ventas.id' ,'ventas.fecha','ventas.observacion',
        'clientes.nombre','clientes.ruc','clientes.direccion','clientes.telefono'
        )
      ->whereBetween(DB::raw('DATE(ventas.fecha)'), [$start_date, $end_date])
       ->leftJoin('clientes', 'ventas.cliId', '=', 'clientes.id')
        //->leftJoin('pagos', 'ventas.id', '=', 'pagos.venId')
        ->get();
 
        $contado= Pago::select(
                                  
            db::raw('(pagos.pago) as parcial')
          )
  ->leftJoin('ventas as ventas','pagos.venId','=','ventas.id')
  ->where('pagos.tipo','Contado')
  ->whereBetween(DB::raw('DATE(ventas.fecha)'), [$start_date, $end_date])
      
->get();
$contado_valor= $contado->sum('parcial');
$transferencia= Pago::select(
                                  
    db::raw('(pagos.pago) as parcial')
  )
->leftJoin('ventas as ventas','pagos.venId','=','ventas.id')
->where('pagos.tipo','Transferencia')
->whereBetween(DB::raw('DATE(ventas.fecha)'), [$start_date, $end_date])

->get();
$transferencia_valor= $transferencia->sum('parcial');
$abono= Pago::select(
                                  
    db::raw('(pagos.pago) as parcial')
  )
->leftJoin('ventas as ventas','pagos.venId','=','ventas.id')
->where('pagos.tipo','Abono')
->whereBetween(DB::raw('DATE(ventas.fecha)'), [$start_date, $end_date])

->get();
$abono_valor= $abono->sum('parcial');
$cheque= Pago::select(
                                  
    db::raw('(pagos.pago) as parcial')
  )
->leftJoin('ventas as ventas','pagos.venId','=','ventas.id')
->where('pagos.tipo','Cheque')
->whereBetween(DB::raw('DATE(ventas.fecha)'), [$start_date, $end_date])

->get();
$cheque_valor= $cheque->sum('parcial');


$totales_venta = [
    'ventas_por_fecha' => $info_venta,
    'ventas_contado' =>     ($contado_valor),
    'ventas_transferencia' =>     ($transferencia_valor),
    'ventas_abono' =>     ($abono_valor),
    'ventas_cheque' =>     ($cheque_valor),
    
    
    
    
  ];
    
      
        return $this->successResponse($totales_venta);
    }


    public function downloadReporteVenta($fechadesde, $fechahasta)
    {

     
      $start_date = Carbon::parse($fechadesde)
      ->toDateTimeString();
      $end_date = Carbon::parse($fechahasta)
      ->toDateTimeString();

      $info_venta= Venta :: select ('ventas.id' ,'ventas.fecha','ventas.observacion',
      'clientes.nombre','clientes.ruc','clientes.direccion','clientes.telefono'
      )
    ->whereBetween(DB::raw('DATE(ventas.fecha)'), [$start_date, $end_date])
     ->leftJoin('clientes', 'ventas.cliId', '=', 'clientes.id')
      //->leftJoin('pagos', 'ventas.id', '=', 'pagos.venId')
      ->get();

      $contado= Pago::select(
                                
          db::raw('(pagos.pago) as parcial')
        )
->leftJoin('ventas as ventas','pagos.venId','=','ventas.id')
->where('pagos.tipo','Contado')
->whereBetween(DB::raw('DATE(ventas.fecha)'), [$start_date, $end_date])
    
->get();
$contado_valor= $contado->sum('parcial');
$transferencia= Pago::select(
                                
  db::raw('(pagos.pago) as parcial')
)
->leftJoin('ventas as ventas','pagos.venId','=','ventas.id')
->where('pagos.tipo','Transferencia')
->whereBetween(DB::raw('DATE(ventas.fecha)'), [$start_date, $end_date])

->get();
$transferencia_valor= $transferencia->sum('parcial');
$abono= Pago::select(
                                
  db::raw('(pagos.pago) as parcial')
)
->leftJoin('ventas as ventas','pagos.venId','=','ventas.id')
->where('pagos.tipo','Abono')
->whereBetween(DB::raw('DATE(ventas.fecha)'), [$start_date, $end_date])

->get();
$abono_valor= $abono->sum('parcial');
$cheque= Pago::select(
                                
  db::raw('(pagos.pago) as parcial')
)
->leftJoin('ventas as ventas','pagos.venId','=','ventas.id')
->where('pagos.tipo','Cheque')
->whereBetween(DB::raw('DATE(ventas.fecha)'), [$start_date, $end_date])

->get();
$cheque_valor= $cheque->sum('parcial');


$info_venta = collect($info_venta);
$contado_valor = collect($contado_valor);
$transferencia_valor = collect($transferencia_valor);
$abono_valor = collect($abono_valor);
$cheque_valor = collect($cheque_valor);

        //  $pdf = PDF::loadView('venta.ventapdf', $data);
        $pdf = PDF::loadView('reporte.reporteventapdf',  
        
        [
          "start_date" => $start_date,
          "end_date" => $end_date,
          
          "info_venta" => $info_venta,
        "contado_valor" => $contado_valor,
        "transferencia_valor" => $transferencia_valor,
        "abono_valor" => $abono_valor,
        "cheque_valor" => $cheque_valor,

      
      ], ['format' => 'A4']);
        $fechas = $fechadesde."-".$fechahasta; 
        
        return $pdf->download($fechas.'reporteventas.pdf');
    }























     
    public function reporteVentasporCLiente($cliId)

    {
        $ventas_cliente= Venta :: select ('ventas.id','pagos.tipo','pagos.total','ventas.fecha','ventas.observacion',
        'clientes.nombre','clientes.ruc','clientes.direccion','clientes.telefono'
        )
       ->leftJoin('clientes', 'ventas.cliId', '=', 'clientes.id')
       ->leftJoin('pagos', 'ventas.id', '=', 'pagos.venId')
     ->where('clientes.id',$cliId)
        ->get();


      
        return $this->successResponse($ventas_cliente);
    }
    public function downloadReporteCliente($cliId)

    {
        $ventas_cliente= Venta :: select ('ventas.id','pagos.tipo','pagos.total','ventas.fecha','ventas.observacion',
        'clientes.nombre','clientes.ruc','clientes.direccion','clientes.telefono'
        )
       ->leftJoin('clientes', 'ventas.cliId', '=', 'clientes.id')
       ->leftJoin('pagos', 'ventas.id', '=', 'pagos.venId')
     ->where('clientes.id',$cliId)
        ->get();

        $ventas_cliente = collect($ventas_cliente);

       // return $ventas_cliente[0]['nombre'];
        $pdf = PDF::loadView('reporte.reporteclientepdf',  
        
        [
          "ventas_cliente" => $ventas_cliente,
  

      
      ], ['format' => 'A4']);
        
        return $pdf->download($ventas_cliente[0]['nombre'].'reporte.pdf');

    }

}



