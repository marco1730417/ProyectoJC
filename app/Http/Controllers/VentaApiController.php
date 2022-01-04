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
use App\Models\Retencion;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Pagination\PaginationState;
use Illuminate\Support\Facades\Config;
use PDF;

class VentaApiController extends ApiResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function createDetalleVenta(Request $request)
    {

        $data = request()->all();

        //$metrosrollo = $data['metrosrollo']; // cantidad de metros totales cuando se venda por rollo

        $precioUnitarioOpcion = $data['precioUnitario'];
        $proId = $data['proId'];

        $descuento = $data['descuento'];

        $infoproducto = Producto::findOrFail($proId);
        if ($precioUnitarioOpcion == 1) {
            $valorPrecio = $infoproducto->PrecioVenta1;
            $metrostotales = $data['cantidad'];
        }

        if ($precioUnitarioOpcion == 2) {
            $valorPrecio = $infoproducto->PrecioVenta2;
            $metrostotales = $infoproducto->metrosrollo * $data['cantidad'];
        }

        if ($precioUnitarioOpcion == 3) {
            $valorPrecio = $infoproducto->PrecioVenta3;
            $metrostotales = $data['cantidad'];
        }
      

        $new_detalle = new DetalleVenta();
        $new_detalle->cantidad = $data['cantidad'];
        $new_detalle->precioUnitario = $valorPrecio;
        $new_detalle->proId =  $data['proId'];
        $new_detalle->venId =  $data['venId'];
        $new_detalle->metrostotales =  $metrostotales;
        $new_detalle->opcion =  $precioUnitarioOpcion;
        $new_detalle->descuento =  $descuento ?: 0;


        $new_detalle->save();

        if ($new_detalle) {
            $actualizar_cantidad_producto = Producto::findOrFail($proId);
            $actualizar_cantidad_producto->unidades = $actualizar_cantidad_producto->unidades - $metrostotales;
            $actualizar_cantidad_producto->update();
        }

        if (!$new_detalle) return $this->errorResponse(500);

        return $this->successResponse(200);
    }



    public function createNuevaVenta()
    {
        $carbon = new \Carbon\Carbon();
        $fecha = $carbon->now();

        $new_venta = new Venta;
        $new_venta->fecha = $fecha;
        $new_venta->save();

        if (!$new_venta) return $this->errorResponse(500);

        return $this->successResponse($new_venta->id);
    }

    //api para guardar pagos al contado


    public function registrarPagoContado(Request $request)
    {
        $carbon = new \Carbon\Carbon();
        $fecha = $carbon->now();
        $data = request()->all();
        $total=$data['total'];
        $pago=$data['pago'];
        $vuelto=$data['vuelto'];
        
        $format_vuelto = number_format($vuelto, 2);
        $format_total = number_format($total, 2);
        $format_pago = number_format($pago, 2);
        $estado=0;

        if( $format_pago>=$format_total )
        $estado=1;  //1 el pago ha sido completo
        if( $format_pago<$format_total )
        $estado=0;  // el pago esta incompleto

        $new_pago = new Pago;
        $new_pago->venId = $data['venId'];
        $new_pago->fecha = $fecha;
        $new_pago->tipo = "Contado";
        $new_pago->cliId =  $data['cliId'];
        $new_pago->vuelto =  $format_vuelto;
        $new_pago->pago =  $format_pago;
        $new_pago->total =  $format_total;
        $new_pago->estado = $estado;

        $new_pago->save();

        if (!$new_pago) return $this->errorResponse(500);

        return $this->successResponse(200);
    }
    public function registrarPagoTransferencia(Request $request)
    {
        $carbon = new \Carbon\Carbon();
        $fecha = $carbon->now();

        $data = request()->all();
        $total=$data['total'];
        $pago=$data['pago'];
        $format_total = number_format($total, 2);
        $format_pago = number_format($pago, 2);
        $estado=0;

        if( $format_pago>=$format_total )
        $estado=1;
        if( $format_pago<$format_total )
        $estado=0;

        $new_pago = new Pago;
        $new_pago->venId = $data['venId'];

        $new_pago->fecha = $fecha;
        $new_pago->tipo = "Transferencia";
        $new_pago->cliId =  $data['cliId'];
       
        $new_pago->pago =  $format_pago;
        $new_pago->total =  $format_total;
        
        $new_pago->numtransf =  $data['numtransf'];
        $new_pago->estado = $estado;
        $new_pago->save();

        if (!$new_pago) return $this->errorResponse(500);

        return $this->successResponse(200);
    }

    public function registrarPagoAbono(Request $request)
    {
        $carbon = new \Carbon\Carbon();
        $fecha = $carbon->now();

        $data = request()->all();
        $total=$data['total'];
        $abono=$data['abono'];
        $saldo=$data['saldo'];

        $format_saldo = number_format($saldo, 2);
      
        $format_total = number_format($total, 2);
        $format_abono = number_format($abono, 2);
        $estado=0;

        if( $format_abono>=$format_total )
        $estado=1;
        if( $format_abono<$format_total )
        $estado=0;


        $new_pago = new Pago;
        $new_pago->venId = $data['venId'];

        $new_pago->fecha = $fecha;
        $new_pago->tipo = "Abono";
        $new_pago->cliId =  $data['cliId'];
        $new_pago->pago =  $format_abono;
        $new_pago->abono =  $format_abono;
        $new_pago->saldo =  $format_saldo;
        $new_pago->total =  $format_total;
        $new_pago->fechamaxima =  $data['fechamaxima'];
        $new_pago->estado = $estado;
        $new_pago->save();

        if (!$new_pago) return $this->errorResponse(500);

        return $this->successResponse(200);
    }
    public function registrarPagoCheque(Request $request)
    {
        $carbon = new \Carbon\Carbon();
        $fecha = $carbon->now();

        $data = request()->all();


        $new_pago = new Pago;
        $new_pago->venId = $data['venId'];
        $new_pago->fecha = $fecha;
        $new_pago->tipo = "Cheque";
        $new_pago->cliId =  $data['cliId'];
        $new_pago->pago = 0;
        $new_pago->total =  $data['total'];
        $new_pago->saldo =  $data['total'];
        $new_pago->fechamaxima =  $data['fechamaxima'];
        $new_pago->cheque =  $data['cheque'];
        $new_pago->estado = 0;

        $new_pago->save();

        if (!$new_pago) return $this->errorResponse(500);

        return $this->successResponse(200);
    }

    public function registrarRetencion(Request $request)
    {
        $carbon = new \Carbon\Carbon();
        $fecha = $carbon->now();

        $data = request()->all();
        $new_retencion = new Retencion();
        $new_retencion->venId = $data['venId'];
        $new_retencion->fecha = $fecha;
        $new_retencion->retencioniva = $data['retencioniva'];
        $new_retencion->impuestorenta = $data['impuestorenta'];
        $new_retencion->save();

        if (!$new_retencion) return $this->errorResponse(500);

        return $this->successResponse(200);
    }
    public function retencionporventa($venId)
    {
        $retenciones= Retencion::where('venId',$venId)->get();
        if (!$retenciones) return $this->errorResponse(500);

        return $this->successResponse($retenciones);
    }
    public function observacionporventa($venId)
    {
        $observacion= Venta::where('id',$venId)->pluck('observacion');
        if (!$observacion) return $this->errorResponse(500);

        return $this->successResponse($observacion);
    }
 

    public function updateVenta(Request $request)
    {
        $carbon = new \Carbon\Carbon();
        $fecha = $carbon->now();

        $data = request()->all();


        $update_venta =  Venta::findOrFail($data['venId']);
        $update_venta->cliId =  $data['cliId'];;

        $update_venta->update();





        if (!$update_venta) return $this->errorResponse(500);

        return $this->successResponse(200);
    }

    public function createDetalleVentabackup(Request $request)
    {

        $data = request()->all();

        $metrosrollo = $data['metrosrollo']; // cantidad de metros totales cuando se venda por rollo

        $precioUnitarioOpcion = $data['precioUnitario'];
        $proId = $data['proId'];
        $precioEspecial = $data['precioEspecial'];
        $descuento = $data['descuento'];

        $infoproducto = Producto::findOrFail($proId);
        if ($precioUnitarioOpcion == 1) {
            $valorPrecio = $infoproducto->PrecioVenta1;
            $metrostotales = $data['cantidad'];
        }

        if ($precioUnitarioOpcion == 2) {
            $valorPrecio = $infoproducto->PrecioVenta2;
            $metrostotales = $metrosrollo * $data['cantidad'];
        }

        if ($precioUnitarioOpcion == 3) {
            $valorPrecio = $infoproducto->PrecioVenta3;
            $metrostotales = $data['cantidad'];
        }
        if ($precioUnitarioOpcion == 4) {
            $valorPrecio = $precioEspecial;
            $metrostotales = $data['cantidad'];
        }

        $new_detalle = new DetalleVenta();
        $new_detalle->cantidad = $data['cantidad'];
        $new_detalle->precioUnitario = $valorPrecio;
        $new_detalle->proId =  $data['proId'];
        $new_detalle->venId =  $data['venId'];
        $new_detalle->metrostotales =  $metrostotales;
        $new_detalle->opcion =  $precioUnitarioOpcion;
        $new_detalle->descuento =  $descuento ?: 0;


        $new_detalle->save();

        if ($new_detalle) {
            $actualizar_cantidad_producto = Producto::findOrFail($proId);
            $actualizar_cantidad_producto->unidades = $actualizar_cantidad_producto->unidades - $metrostotales;
            $actualizar_cantidad_producto->update();
        }

        if (!$new_detalle) return $this->errorResponse(500);

        return $this->successResponse(200);
    }

    public function getInformacionVenta($venId)
    {
        $detalle_venta = DetalleVenta::select(
            'detalle_ventas.cantidad',
            'detalle_ventas.id',
            'detalle_ventas.opcion',
            'detalle_ventas.descuento',
            'detalle_ventas.precioUnitario',
            'productos.nombre',
            'productos.descripcion',
            'productos.uniPrecioVenta1',
            'productos.uniPrecioVenta2',
            'productos.uniPrecioVenta3',
            
            db::raw('detalle_ventas.cantidad*detalle_ventas.precioUnitario as subTotal'),

        )
            ->leftJoin('ventas', 'detalle_ventas.id', '=', 'ventas.id')
            ->leftJoin('productos', 'detalle_ventas.proId', '=', 'productos.id')
            ->leftJoin('clientes', 'ventas.cliId', '=', 'clientes.id')

            ->where('venId', $venId)->get();
        return $this->successResponse($detalle_venta);
    }

    public function getInformacionPagosVenta($venId)
    {
        $detalle_venta = Pago::select(
            'pagos.id',
            'pagos.tipo',
            'pagos.total',
            'pagos.pago',
            'pagos.abono',
            'pagos.fechamaxima',
            'pagos.saldo',
            'pagos.fecha',
            'pagos.venId',
            'pagos.cliId'
        )
            ->leftJoin('ventas', 'pagos.venId', '=', 'ventas.id')
            ->leftJoin('clientes', 'pagos.cliId', '=', 'clientes.id')
            ->where('venId', $venId)
            ->get();
        //    return $detalle_venta;
        $total_pagos = Pago::where('pagos.venId', $venId)->sum('pagos.pago');
        $saldo = $detalle_venta[0]['total'] - $total_pagos;
      
        $totalcobrar = $detalle_venta[0]['total'];
        $fechamaxima = $detalle_venta[0]['fechamaxima'];


        $info_pago_abono = [
            'detalle_venta' => $detalle_venta,
            'total_abonos' =>     $total_pagos,
            'fechamaxima' => $fechamaxima,
            'saldo' => $saldo,
            'totalcobrar' => $totalcobrar,

        ];

        return $this->successResponse($info_pago_abono);
    }
    public function getInformacionPagosVentaAbonos($venId)
    {
        $detalle_venta = Pago::select(
            'pagos.id',
            'pagos.tipo',
            'pagos.total',
            'pagos.pago',
            'pagos.abono',
            'pagos.fechamaxima',
            'pagos.saldo',
            'pagos.fecha',
            'pagos.venId',
            'pagos.cliId'
        )
            ->leftJoin('ventas', 'pagos.venId', '=', 'ventas.id')
            ->leftJoin('clientes', 'pagos.cliId', '=', 'clientes.id')
            ->where('venId', $venId)
            ->where('pagos.tipo','=','Abono')
            
            ->get();
        $total_abonos = Pago::where('pagos.venId', $venId)->sum('pagos.abono');
        $saldo = $detalle_venta[0]['total'] - $total_abonos;
        $totalcobrar = $detalle_venta[0]['total'];
        $fechamaxima = $detalle_venta[0]['fechamaxima'];


        $info_pago_abono = [
            'detalle_venta' => $detalle_venta,
            'total_abonos' =>     $total_abonos,
            'fechamaxima' => $fechamaxima,
            'saldo' => $saldo,
            'totalcobrar' => $totalcobrar,

        ];

        return $this->successResponse($info_pago_abono);
    }

    


    public function deleteRetencion($retId)
    {
        $retencion = Retencion::findOrFail($retId)->delete();

        if (!$retencion) return $this->errorResponse(500);
        return $this->successResponse(200);
    }

    public function deleteVenta($venId)
    {
        $infodetalle =  DetalleVenta::where('venId', $venId)->get();
        $pagos_asociados= Pago::where('venId',$venId)->get();
        $collectionpagos = collect($pagos_asociados);
        $collectionpagos->each(function ($item, $key) {
            Pago::where('id', $item->id)->delete();
        });
        
        
        
        $collection = collect($infodetalle);
        $collection->each(function ($item, $key) {
            $update_producto = Producto::findOrFail($item->proId);
            $update_producto->unidades = $update_producto->unidades + $item->cantidad;
            $update_producto->update();
            DetalleVenta::where('venId', $item->venId)->delete();
        });
        Venta::where('id', $venId)->delete();
        if (!$collection) return $this->errorResponse(500);
        return $this->successResponse(200);
    }


    public function deleteDetalleVenta($id)
    {
        $infodetalle = DetalleVenta::findOrFail($id);
        $update_producto = Producto::findOrFail($infodetalle->proId);
        $update_producto->unidades = $update_producto->unidades + $infodetalle->cantidad;
        $update_producto->update();

        $detalle_delete = DetalleVenta::findOrFail($id);
        $detalle_delete->delete();
        if (!$detalle_delete) return $this->errorResponse(500);
        return $this->successResponse(200);
    }


    public function detalleGeneralVenta($venId)
    {


        $info_venta = Venta::select(
            'ventas.id',
            'ventas.fecha',
            'clientes.nombre',
            'clientes.ruc',
            'clientes.id as cliId',
            'clientes.direccion',
            'clientes.telefono',
            'ventas.metodopago'
        )
            ->leftJoin('clientes', 'ventas.cliId', '=', 'clientes.id')
            ->where('ventas.id', $venId)->get();

        $info_cliente = Cliente::select(
            'clientes.id',
            'clientes.nombre',
            'clientes.ruc',
            'clientes.direccion',
            'clientes.telefono',
            'clientes.email',
            'clientes.created_at',
            'clientes.updated_at'
        )
            ->leftJoin('ventas', 'ventas.cliId', '=', 'clientes.id')
            ->where('ventas.id', $venId)
            ->get();

        $informacion_venta = [
            'cliente' => $info_cliente,
            'total' => $info_venta
        ];



        return $this->successResponse($informacion_venta);
    }

    public function totalesVenta($venId)
    {


        $parciales = DetalleVenta::queryVentaParcial($venId)->get();
        $descuentos = DetalleVenta::queryDescuentos($venId)->get();
        $descuentos_total = $descuentos->sum('descuentos');
        $subtotal = $parciales->sum('parcial');
        $subtotal_sin_impuestos = $subtotal - $descuentos_total;

        $iva = 12;
        $valor_iva = $subtotal * $iva / 100;
        $total = $subtotal + $valor_iva;

        $totales_venta = [
            'subtotalprecio' => $subtotal,
            'descuentos' => $descuentos_total,
            'subtotal_sin_impuestos' => $subtotal_sin_impuestos,
            'iva' =>     round($iva),
            'valorIva' => $valor_iva,
            'total' => $total
        ];

        //return $this->successResponse($totales_cotizacion);

        $total_venta = collect($totales_venta);
        return $total_venta;
    }


    public function downloadVenta($venId)
    {

        $detalle_venta = DetalleVenta::select(
            'detalle_ventas.cantidad',
            'detalle_ventas.id',
            'detalle_ventas.precioUnitario',
            'detalle_ventas.opcion',
            'detalle_ventas.descuento',
            'productos.nombre',
            'productos.descripcion',
            'productos.uniPrecioVenta1',
            'productos.uniPrecioVenta2',
            'productos.uniPrecioVenta3',

            db::raw('detalle_ventas.cantidad*detalle_ventas.precioUnitario as subTotal')
      
        )
            ->leftJoin('ventas', 'detalle_ventas.id', '=', 'ventas.id')
            ->leftJoin('productos', 'detalle_ventas.proId', '=', 'productos.id')
            ->leftJoin('clientes', 'ventas.cliId', '=', 'clientes.id')
            ->where('venId', $venId)->get();

        $parciales = DetalleVenta::queryVentaParcial($venId)->get();
        $descuentos = DetalleVenta::queryDescuentos($venId)->get();
        $descuentos_total = $descuentos->sum('descuentos');
        $subtotal = $parciales->sum('parcial');
        $subtotal_sin_impuestos = $subtotal - $descuentos_total;
        $iva = 12;
        $valor_iva = $subtotal * $iva / 100;
        $total = $subtotal + $valor_iva;

        $totales_venta = [
            'subtotalprecio' => $subtotal,
            'descuentos' => $descuentos_total,
            'subtotal_sin_impuestos' => $subtotal_sin_impuestos,
            'iva' =>     round($iva),
            'valorIva' => $valor_iva,
            'total' => $total
        ];

        //return $this->successResponse($totales_cotizacion);

        $total_venta = collect($totales_venta);


        $info_venta = Venta::select('ventas.id', 'ventas.fecha', 'clientes.nombre', 'clientes.ruc', 'clientes.direccion', 'clientes.telefono', 'ventas.metodopago')
            ->leftJoin('clientes', 'ventas.cliId', '=', 'clientes.id')
            ->where('ventas.id', $venId)->get();
/* return $info_venta[0]['nombre'];
 */

        //  $pdf = PDF::loadView('venta.ventapdf', $data);
        $pdf = PDF::loadView('venta.ventapdf',  ["detalle_venta" => $detalle_venta, "total_venta" => $total_venta, "info_venta" => $info_venta], ['format' => 'A4']);

      //  return $pdf->download('venta.pdf');
        return $pdf->download($venId.$info_venta[0]['nombre'].'- venta.pdf');
    }

    public function detalleVenta()
    {


        $info_venta = Venta::select(
            'ventas.id',
            'ventas.fecha',
            'ventas.observacion',

            'clientes.nombre',
            'clientes.ruc',
            'clientes.direccion',
            'clientes.telefono',

            DB::raw("(SELECT sum(detalle_ventas.cantidad*detalle_ventas.precioUnitario) FROM detalle_ventas
        WHERE ventas.id=detalle_ventas.venId
        ) AS total"),
        DB::raw("(SELECT count(pagos.id) FROM pagos
        WHERE ventas.id=pagos.venId
        and pagos.tipo='Abono'
        ) AS pagoabonos"),
        )
        



            ->leftJoin('clientes', 'ventas.cliId', '=', 'clientes.id')
            ->orderBy('ventas.fecha', 'desc')

            ->get();

        return $this->successResponse($info_venta);
    }

    /* 
Esta api muestra metodos de pagos asociados y por ende en ocasiones muestra dos valores en la vista principal y por eso se ha decidido que mejor
se evite poner esta accion y unificar campos en una unica api */

    public function detalleVentav1()
    {


        $info_venta = Venta::select(
            'ventas.id',
            'pagos.tipo',
            'pagos.total as totales',
            'ventas.fecha',
            'ventas.observacion',

            'clientes.nombre',
            'clientes.ruc',
            'clientes.direccion',
            'clientes.telefono',

            DB::raw("(SELECT sum(detalle_ventas.cantidad*detalle_ventas.precioUnitario) FROM detalle_ventas
        WHERE ventas.id=detalle_ventas.venId
        ) AS total"),
        )



            ->leftJoin('clientes', 'ventas.cliId', '=', 'clientes.id')
            ->leftJoin('pagos', 'ventas.id', '=', 'pagos.venId')
            ->orderBy('ventas.fecha', 'desc')

            ->get();

        return $this->successResponse($info_venta);
    }


    public function totalDashboardVentas()
    {


        $venta_parciales = DetalleVenta::select(

            db::raw('(detalle_ventas.cantidad*detalle_ventas.precioUnitario) as parcial')
        )->get();
        $subtotal = $venta_parciales->sum('parcial');

        $total_de_ventas= Pago::sum('total');

        $numero_clientes = Venta::distinct('cliId')->count('cliId');


        $max_venta = Venta::select(
            DB::raw("(SELECT sum(detalle_ventas.cantidad*detalle_ventas.precioUnitario) FROM detalle_ventas
        WHERE ventas.id=detalle_ventas.venId
        ) AS total"),
        )->leftJoin('clientes', 'ventas.cliId', '=', 'clientes.id')->get();;

        /* $max_venta= Pago::max('total'); */

        $maxima_venta = $max_venta->max('total');
        // se aplican valores sin iva Si funcionan las lineas de abajo para mostrar el valor maximo con iva
        $iva = 12;
        $valor_iva = $maxima_venta * $iva / 100;
        $maxima = $maxima_venta + $valor_iva;

        $numero_productos = Producto::count('id');

        $productos_stock = Producto::where('unidades', '<', 10)->orderBy('unidades')->get();

        $productos_mas_vendidos = DetalleVenta::select(
            'proId',
            'productos.nombre',
            DB::raw("(SELECT count(detalle_ventas.proId) FROM detalle_ventas
        ) AS total"),
        )
            ->leftJoin('productos', 'productos.id', '=', 'detalle_ventas.proId')
            ->groupBy('proId')->orderBy('total')->take(5)->get();

        $mejores_clientes = Venta::select(
            'cliId',
            'clientes.nombre',
            DB::raw("(SELECT count(ventas.cliId) FROM ventas
        ) AS total"),
        )
            ->leftJoin('clientes', 'ventas.cliId', '=', 'clientes.id')
            ->groupBy('cliId')->orderBy('total')->take(1)->get();

            $frutas= Pago::select(
                DB::raw('sum(total) as sum'),
                DB::raw("DATE_FORMAT(fecha,'%M %Y') as months")
            )
                ->groupBy('months')
                ->get();
                $collection = collect($frutas);
            /*     $squares = array_map(function($mes) {
                    return $mes['sum']*1;
                }, $frutas);

                return $squares;
 */
        /*   $ventas_mes= Venta::select(
        DB::raw("(SELECT sum(detalle_ventas.cantidad*detalle_ventas.precioUnitario) FROM detalle_ventas
        WHERE ventas.id=detalle_ventas.venId
        ) AS total"),

                DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
            )   ->groupBy('months' )
                ->get();  */

        /* 
                $ventas_mes=                DB::table('ventas')
                ->select(DB::raw('DATE(created_at) as date'),
                DB::raw("(SELECT sum(detalle_ventas.cantidad*detalle_ventas.precioUnitario) FROM detalle_ventas
                WHERE ventas.id=detalle_ventas.venId
                ) AS total"),
                 )
                ->groupBy('date')
                ->get(); */
        /*      $ventas_mes = Venta::where('created_at', '>=', \Carbon\Carbon::now->subMonth())
                ->groupBy('date')
                ->orderBy('date', 'DESC')
                ->get(array(
                    DB::raw('Date(created_at) as date'),
                    DB::raw("(SELECT sum(detalle_ventas.cantidad*detalle_ventas.precioUnitario) FROM detalle_ventas
                WHERE ventas.id=detalle_ventas.venId
                ) AS total")
                ));
 */

        $info_dashboard = [
            'subtotal' => $total_de_ventas,
            'cliente' =>     $numero_clientes,
            'max_venta' => $max_venta,
            'numero_productos' => $numero_productos,
            'productos_stock' => $productos_stock,
            'productos_mas_vendidos' => $productos_mas_vendidos,
            'mejores_clientes' => $mejores_clientes,
            'meses'=> $collection


        ];


        return $this->successResponse($info_dashboard);
    }



    public function UpdateObservacion(Request $request)
    {

        $data = request()->all();

        $id = $data['id'];
        $observacion = $data['observacion'];



        $venta_update = Venta::findOrFail($id);
        $venta_update->observacion = $observacion;
        $venta_update->update();


        if (!$venta_update) return $this->errorResponse(500);
        return $this->successResponse(200);
    }


    public function registrarabono(Request $request)
    {


        $carbon = new \Carbon\Carbon();
        $fecha = $carbon->now();


        $data = request()->all();
        ///primero sacamos la venta
        $info = $data['info'];
        $venId = $info[0]['venId'];
        // obtenemos el ultimo saldo pendiente
        $saldo_anterior= Pago::where('venId',$venId)->get()->last();
        $saldo_anterior=$saldo_anterior->saldo;
      //  return $saldo_anterior->saldo;

        $total = $info[0]['total'];
        $fechamaxima = $info[0]['fechamaxima'];
       // $saldo_anterior = $info[0]['saldo'];
      
        $cliId = $info[0]['cliId'];
        $pago = $data['pago'];
        $saldo_actual = $data['saldo'];
        $total=$info[0]['total'];
        
        $format_total = number_format($total, 2);
        $format_pago = number_format($pago, 2);
        $saldo_anterior = number_format($saldo_anterior, 2);
        $saldo_actual = number_format($saldo_actual, 2);
      
        $estado=0;

        if( $format_pago>=$saldo_anterior )
        $estado=1;  //1 el pago ha sido completo
        if( $format_pago<$saldo_anterior )
        $estado=0;  // el pago esta incompleto



        $new_pago = new Pago;
        $new_pago->fecha = $fecha;
        $new_pago->cliId =  $cliId;
        $new_pago->tipo = "Abono";
        $new_pago->venId =  $venId;

        $new_pago->pago =  $format_pago;
        $new_pago->abono =  $format_pago;
        $new_pago->saldo =  $saldo_actual;
        //$new_pago->total =  $total;
        $new_pago->fechamaxima =  $fechamaxima;
        $new_pago->estado =  $estado;
        

        $new_pago->save();

        if (!$new_pago) return $this->errorResponse(500);

        return $this->successResponse(200);
    }
}
