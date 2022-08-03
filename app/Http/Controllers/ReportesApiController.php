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
use PDF;

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

    $info_venta = Venta::select(
      'ventas.id',
      'ventas.fecha',
      'ventas.observacion',
      'clientes.nombre',
      'clientes.ruc',
      'clientes.direccion',
      'clientes.telefono',
      DB::raw("(SELECT (pagos.saldo) FROM pagos
                    WHERE ventas.id=pagos.venId
                    and pagos.total is not null
            ORDER BY pagos.saldo
            limit 1
            ) AS saldos"),
      DB::raw("(SELECT (pagos.abono) FROM pagos
            WHERE ventas.id=pagos.venId

            and pagos.total is not null
            ORDER BY pagos.saldo
            limit 1
            ) AS abono"),
      DB::raw("(SELECT (pagos.tipo) FROM pagos
            WHERE ventas.id=pagos.venId

            and pagos.total is not null
            ORDER BY pagos.saldo
            limit 1
            ) AS tipo"),
      DB::raw("(SELECT (pagos.total) FROM pagos
            WHERE ventas.id=pagos.venId

            and pagos.total is not null
            ORDER BY pagos.saldo
            limit 1
            ) AS total"),
      DB::raw("(SELECT (pagos.fechamaxima) FROM pagos
            WHERE ventas.id=pagos.venId

            and pagos.total is not null
            ORDER BY pagos.saldo
            limit 1
            ) AS fechamaxima"),
    )
      ->whereBetween(DB::raw('DATE(ventas.fecha)'), [$start_date, $end_date])
      ->leftJoin('clientes', 'ventas.cliId', '=', 'clientes.id')
      ->get();


    $valores_abonos = Pago::select(
      'pagos.id as pagiD',
      'pagos.pago',
      'pagos.abono',
      'pagos.saldo',
      'pagos.detalleabono',
      'pagos.fecha',
      'pagos.tipoabono',
      'pagos.tipo',
  
      'ventas.id',
      'ventas.observacion',
      'clientes.nombre',
      'clientes.ruc',
      'clientes.direccion',
      'clientes.telefono'
    )
      ->leftJoin('clientes', 'clientes.id', '=', 'pagos.cliId')
      ->leftJoin('ventas', 'ventas.id', '=', 'pagos.venId')
      ->whereBetween(DB::raw('DATE(pagos.fecha)'), [$start_date, $end_date])
      ->whereNull('pagos.total')
      ->get();


    $abonos_credito = Pago::select(

      db::raw('round((pagos.pago),2) as parcial')
    )
      ->leftJoin('ventas as ventas', 'pagos.venId', '=', 'ventas.id')
      ->where('pagos.tipo', 'Credito')
      ->whereNull('pagos.total')
      ->whereBetween(DB::raw('DATE(pagos.fecha)'), [$start_date, $end_date])
      ->get();
    $abonos_credito_total = $abonos_credito->sum('parcial');

    $abonos_abono = Pago::select(

      db::raw('round((pagos.pago),2) as parcial')
    )
      ->leftJoin('ventas as ventas', 'pagos.venId', '=', 'ventas.id')
      ->where('pagos.tipo', 'Abono')
      ->whereNull('pagos.total')
      ->whereBetween(DB::raw('DATE(pagos.fecha)'), [$start_date, $end_date])
      ->get();
    $abonos_abono_total = $abonos_abono->sum('parcial');



    $contado = Pago::select(

      db::raw('round((pagos.total),2) as parcial')
    )
      ->leftJoin('ventas as ventas', 'pagos.venId', '=', 'ventas.id')
      ->where('pagos.tipo', 'Contado')
      ->whereBetween(DB::raw('DATE(ventas.fecha)'), [$start_date, $end_date])
      ->get();
    $contado_valor = $contado->sum('parcial');

    $transferencia = Pago::select(

      db::raw('round((pagos.total),2) as parcial')
    )
      ->leftJoin('ventas as ventas', 'pagos.venId', '=', 'ventas.id')
      ->where('pagos.tipo', 'Transferencia')
      ->whereBetween(DB::raw('DATE(ventas.fecha)'), [$start_date, $end_date])

      ->get();
    $transferencia_valor = $transferencia->sum('parcial');
    $abono = Pago::select(

      db::raw('round((pagos.pago),2) as parcial')
    )
      ->leftJoin('ventas as ventas', 'pagos.venId', '=', 'ventas.id')
      ->where('pagos.tipo', 'Abono')
      ->whereBetween(DB::raw('DATE(ventas.fecha)'), [$start_date, $end_date])

      ->get();
    $abono_valor = $abono->sum('parcial');
    $cheque = Pago::select(

      db::raw('round((pagos.total),2) as parcial')
    )
      ->leftJoin('ventas as ventas', 'pagos.venId', '=', 'ventas.id')
      ->where('pagos.tipo', 'Cheque')
      ->whereBetween(DB::raw('DATE(ventas.fecha)'), [$start_date, $end_date])

      ->get();
    $cheque_valor = $cheque->sum('parcial');

    $credito = Pago::select(

      db::raw('round((pagos.total),2) as parcial')
    )
      ->leftJoin('ventas as ventas', 'pagos.venId', '=', 'ventas.id')
      ->where('pagos.tipo', 'Credito')
      ->whereBetween(DB::raw('DATE(ventas.fecha)'), [$start_date, $end_date])

      ->get();
    $credito_valor = $credito->sum('parcial');

    $totales_venta = [
      'ventas_por_fecha' => $info_venta,
      'ventas_contado' => ($contado_valor),
      'ventas_transferencia' => ($transferencia_valor),
      'ventas_abono' => ($abono_valor),
      'ventas_cheque' => ($cheque_valor),
      'ventas_credito' => ($credito_valor),

      'ventas_fecha_abonos' => $valores_abonos,
      'abonos_credito_total' => ($abonos_credito_total),
      'abonos_abono_total' => ($abonos_abono_total),

    ];


    return $this->successResponse($totales_venta);
  }


  public function downloadReporteVenta($fechadesde, $fechahasta)
  {


    $start_date = Carbon::parse($fechadesde) ->toDateTimeString();
    $format_start_date= Carbon::parse($fechadesde) ->toFormattedDateString();
    
    $end_date = Carbon::parse($fechahasta)  ->toDateTimeString();
    $format_end_date= Carbon::parse($fechahasta) ->toFormattedDateString();
    


    $info_venta = Venta::select(
      'ventas.id',
      'ventas.fecha',
      'ventas.observacion',
      'clientes.nombre',
      'clientes.ruc',
      'clientes.direccion',
      'clientes.telefono',
      DB::raw("(SELECT (pagos.saldo) FROM pagos
        WHERE ventas.id=pagos.venId
        and pagos.total is not null
      ORDER BY pagos.saldo
      limit 1
      ) AS saldos"),
            DB::raw("(SELECT (pagos.abono) FROM pagos
      WHERE ventas.id=pagos.venId
      and pagos.total is not null
      ORDER BY pagos.saldo
      limit 1
      ) AS abono"),
            DB::raw("(SELECT (pagos.tipo) FROM pagos
      WHERE ventas.id=pagos.venId
      and pagos.total is not null
      ORDER BY pagos.saldo
      limit 1
      ) AS tipo"),
            DB::raw("(SELECT (pagos.total) FROM pagos
      WHERE ventas.id=pagos.venId
      and pagos.total is not null
      ORDER BY pagos.saldo
      limit 1
      ) AS total"),
            DB::raw("(SELECT (pagos.fechamaxima) FROM pagos
      WHERE ventas.id=pagos.venId
      and pagos.total is not null
      ORDER BY pagos.saldo
      limit 1
      ) AS fechamaxima"),

    )
      ->whereBetween(DB::raw('DATE(ventas.fecha)'), [$start_date, $end_date])
      ->leftJoin('clientes', 'ventas.cliId', '=', 'clientes.id')
      ->get();

    $contado = Pago::select(

      db::raw('round((pagos.total),2) as parcial')
    )
      ->leftJoin('ventas as ventas', 'pagos.venId', '=', 'ventas.id')
      ->where('pagos.tipo', 'Contado')
      ->whereBetween(DB::raw('DATE(ventas.fecha)'), [$start_date, $end_date])

      ->get();
    $contado_valor = $contado->sum('parcial');

    $transferencia = Pago::select(

      db::raw('round((pagos.total),2) as parcial')
    )
      ->leftJoin('ventas as ventas', 'pagos.venId', '=', 'ventas.id')
      ->where('pagos.tipo', 'Transferencia')
      ->whereBetween(DB::raw('DATE(ventas.fecha)'), [$start_date, $end_date])

      ->get();
    $transferencia_valor = $transferencia->sum('parcial');
    $abono = Pago::select(

      db::raw('(pagos.pago) as parcial')
    )
      ->leftJoin('ventas as ventas', 'pagos.venId', '=', 'ventas.id')
      ->where('pagos.tipo', 'Abono')
      ->whereBetween(DB::raw('DATE(ventas.fecha)'), [$start_date, $end_date])

      ->get();
    $abono_valor = $abono->sum('parcial');
    $cheque = Pago::select(

      db::raw('round((pagos.total),2) as parcial')
    )
      ->leftJoin('ventas as ventas', 'pagos.venId', '=', 'ventas.id')
      ->where('pagos.tipo', 'Cheque')
      ->whereBetween(DB::raw('DATE(ventas.fecha)'), [$start_date, $end_date])
      ->get();
    $credito = Pago::select(

      db::raw('round((pagos.total),2) as parcial')
    )
      ->leftJoin('ventas as ventas', 'pagos.venId', '=', 'ventas.id')
      ->where('pagos.tipo', 'Credito')
      ->whereBetween(DB::raw('DATE(ventas.fecha)'), [$start_date, $end_date])

      ->get();

      /* 
      CALCULOS PARA ABONOS DE CREDITO O ABONO */

      $valores_abonos = Pago::select(
        'pagos.id as pagiD',
        'pagos.pago',
        'pagos.abono',
        'pagos.saldo',
        'pagos.detalleabono',
        'pagos.fecha',
        'pagos.tipoabono',
        'pagos.tipo',
        'ventas.id',
        'ventas.observacion',
        'clientes.nombre',
        'clientes.ruc',
        'clientes.direccion',
        'clientes.telefono'
      )
        ->leftJoin('clientes', 'clientes.id', '=', 'pagos.cliId')
        ->leftJoin('ventas', 'ventas.id', '=', 'pagos.venId')
        ->whereBetween(DB::raw('DATE(pagos.fecha)'), [$start_date, $end_date])
        ->whereNull('pagos.total')
        ->get();
  
  
      $abonos_credito = Pago::select(
  
        db::raw('round((pagos.pago),2) as parcial')
      )
        ->leftJoin('ventas as ventas', 'pagos.venId', '=', 'ventas.id')
        ->where('pagos.tipo', 'Credito')
        ->whereNull('pagos.total')
        ->whereBetween(DB::raw('DATE(pagos.fecha)'), [$start_date, $end_date])
        ->get();
      
        $abonos_credito_total = $abonos_credito->sum('parcial');
  
      $abonos_abono = Pago::select(
  
        db::raw('round((pagos.pago),2) as parcial')
      )
        ->leftJoin('ventas as ventas', 'pagos.venId', '=', 'ventas.id')
        ->where('pagos.tipo', 'Abono')
        ->whereNull('pagos.total')
        ->whereBetween(DB::raw('DATE(pagos.fecha)'), [$start_date, $end_date])
        ->get();
      $abonos_abono_total = $abonos_abono->sum('parcial');

      



    $credito_valor = $credito->sum('parcial');
    $cheque_valor = $cheque->sum('parcial');
    $info_venta = collect($info_venta);
    $contado_valor = ($contado_valor);
    $transferencia_valor = ($transferencia_valor);
    $abono_valor = ($abono_valor);
    $cheque_valor = ($cheque_valor);
    $credito_valor = ($credito_valor);

    //  $pdf = PDF::loadView('venta.ventapdf', $data);
    $pdf = PDF::loadView(
      'reporte.reporteventapdf',

      [
        "start_date" => $format_start_date,
        "end_date" => $format_end_date,
        "abonos_abono_total"=>$abonos_abono_total,
        "abonos_credito_total"=>$abonos_credito_total,
      
        "valores_abonos"=>$valores_abonos,

        "info_venta" => $info_venta,
        "info_venta" => $info_venta,
        "contado_valor" => $contado_valor,
        "transferencia_valor" => $transferencia_valor,
        "abono_valor" => $abono_valor,
        "cheque_valor" => $cheque_valor,
        "credito_valor" => $credito_valor,


      ],
      ['format' => 'A4']
    );
    $fechas = $fechadesde . "-" . $fechahasta;

    return $pdf->download($fechas . 'reporteventas.pdf');
  }


  public function reporteVentasporCLiente($cliId)

  {
  
    $ventas_cliente= Pago::select(
      'ventas.id as venId',
      'pagos.id as pagId',
      'ventas.estadopago as estadopago',
      'pagos.cliId as cliId',
      'pagos.fechamaxima as fechamaxima',
      'pagos.saldo as saldos',
      'pagos.cheque as cheque',
      'pagos.numtransf as numtransf',
      'pagos.detallecontado as detallecontado',
      'pagos.detalleabono as detalleabono',
      'pagos.tipo as tipo',
      'pagos.total as total',
      'ventas.fecha as fecha',
      'clientes.nombre as nombre'
   )
      ->leftJoin('ventas', 'pagos.venId', '=', 'ventas.id')
      ->leftJoin('clientes', 'pagos.cliId', '=', 'clientes.id')
      ->where('ventas.estadopago',1)
      ->where('clientes.id', $cliId)
      ->wherenotNull('pagos.total')
      ->orderBy('ventas.fecha')
      ->get();

    return $ventas_cliente;
  }






  public function reporteDeudasporCliente($cliId)

  {

     $ventas_pendientes = Venta::select(
      'id as venId',
      'estadopago',
      'cliId',
      'ventas.fecha',
      DB::raw("(SELECT (pagos.saldo) FROM pagos
         WHERE ventas.id=pagos.venId
         ORDER BY pagos.saldo
         limit 1
         ) AS saldos"),

         DB::raw("(SELECT (pagos.tipo) FROM pagos
         WHERE ventas.id=pagos.venId
         ORDER BY pagos.saldo
         limit 1
         ) AS tipo"),
    )
      ->where('cliId', $cliId)
      ->where('estadopago', 0)
      ->get();


    return $ventas_pendientes;
  }






  public function reporteTotalDeudasporCliente($cliId)

  {

    //1 Sacar ventas con estado 0 asociadas a este cliente
    $ventas_pendientes = Venta::select(
      'id as venId',
      'estadopago',
      'cliId',
      'ventas.fecha',
      DB::raw("(SELECT (pagos.saldo) FROM pagos
         WHERE ventas.id=pagos.venId
         ORDER BY pagos.saldo
         limit 1
         ) AS saldos")

    )
      ->where('cliId', $cliId)
      ->where('estadopago', 0)
      ->get();


   $total=  $ventas_pendientes->sum('saldos');

    return $total;
  }
  public function downloadReporteCliente($cliId)

  {
 

      $ventas_cliente=  ReportesApiController::reporteVentasporCLiente($cliId);
      $ventas_deuda=  ReportesApiController::reporteDeudasporCliente($cliId);
      $total_deuda=  ReportesApiController::reporteTotalDeudasporCliente($cliId);
      
      
    //  return $ventas_deuda;

    $ventas_cliente = collect($ventas_cliente);
    $ventas_deuda = collect($ventas_deuda);
    

    // return $ventas_cliente[0]['nombre'];
    $pdf = PDF::loadView(
      'reporte.reporteclientepdf',

      [
        "ventas_cliente" => $ventas_cliente,
        "ventas_deuda" => $ventas_deuda,
        "total_deuda" => $total_deuda,
     
      ],
      ['format' => 'A4']
    );

    return $pdf->download($ventas_cliente[0]['nombre'] . 'reporte.pdf');
  }







  public function reporteCompras($fechadesde, $fechahasta)
  {

    $start_date = Carbon::parse($fechadesde)
      ->toDateTimeString();
    $end_date = Carbon::parse($fechahasta)
      ->toDateTimeString();

    $info_compra = Compras::select(
      'compras.id',
      'compras.fecha',
      'compras.total',
      'proveedores.nombre',
      'proveedores.ruc',
      'compras.comprobante'
    )
      ->whereBetween(DB::raw('DATE(compras.fecha)'), [$start_date, $end_date])
      ->leftJoin('proveedores', 'compras.prvId', '=', 'proveedores.id')
      //->leftJoin('pagos', 'ventas.id', '=', 'pagos.venId')
      ->get();
    /* 
        $totales= Compras::sum(
                                  'total'
        )
->whereBetween(DB::raw('DATE(compras.fecha)'), [$start_date, $end_date])
    
->get(); */


    $totales = Compras::select(

      db::raw('(compras.total) as parcial')
    )
      ->whereBetween(DB::raw('DATE(compras.fecha)'), [$start_date, $end_date])

      ->get();
    $total_valor = $totales->sum('parcial');



    $totales_compra = [
      'compras_por_fecha' => $info_compra,
      'total_compras' => $total_valor


    ];


    return $this->successResponse($totales_compra);
  }

  public function reporteVentasporCLiente1($cliId)

  {
  
    //1 Sacar ventas con estado 0 asociadas a este cliente es decir ventas que el cliente NO ADEUDA NINGUN VALOR
    $ventas_cliente = Venta::select(
      'ventas.id as venId',
      'estadopago',
      'cliId',
      'ventas.fecha',
      'ventas.observacion',
      'clientes.nombre',
      'clientes.ruc',
            DB::raw("(SELECT (pagos.saldo) FROM pagos
              WHERE ventas.id=pagos.venId
      ORDER BY pagos.saldo
      limit 1
      ) AS saldos"),
            DB::raw("(SELECT (pagos.abono) FROM pagos
      WHERE ventas.id=pagos.venId
      ORDER BY pagos.saldo
      limit 1
      ) AS abono"),
            DB::raw("(SELECT (pagos.tipo) FROM pagos
      WHERE ventas.id=pagos.venId

      ORDER BY pagos.saldo
      limit 1
      ) AS tipo"),
            DB::raw("(SELECT (pagos.total) FROM pagos
      WHERE ventas.id=pagos.venId
      ORDER BY pagos.saldo
      limit 1
      ) AS total"),
            DB::raw("(SELECT (pagos.fechamaxima) FROM pagos
      WHERE ventas.id=pagos.venId
      ORDER BY pagos.saldo
      limit 1
      ) AS fechamaxima"),
    )

      ->leftJoin('clientes', 'ventas.cliId', '=', 'clientes.id')
      ->where('cliId', $cliId)
      ->where('ventas.estadopago', 1)
      ->get();

    return $this->successResponse($ventas_cliente);
  }
/* 
 Version 2 = Ajustar la apo */
 public function reporteDeudasporCliente1($cliId)
 { 

     $ventas_pendientes= Pago::select(
         'ventas.id as venId',
         'pagos.id as pagId',
         'ventas.estadopago as estadopago',
         'pagos.cliId as cliId',
         'pagos.fechamaxima as fechamaxima',
         'pagos.saldo as saldos',
         'pagos.cheque as cheque',
         'pagos.numtransf as numtransf',
         'pagos.detalleabono as detalleabono',
         'pagos.tipo as tipo',
         'pagos.total as total',
         'ventas.fecha as fecha',
         'clientes.nombre as nombre'
         )
         ->leftJoin('ventas', 'pagos.venId', '=', 'ventas.id')
         ->leftJoin('clientes', 'pagos.cliId', '=', 'clientes.id')
         ->where('clientes.id', $cliId)
         ->where('ventas.estadopago',0)
          ->where('pagos.tipo','<>','Contado')
         ->where('pagos.tipo','<>','Transferencia')
         ->where('pagos.tipo','<>','Transferencia')
         ->orderBy('pagos.saldo')
         ->get();

       return $this->successResponse($ventas_pendientes);

 } 



}
