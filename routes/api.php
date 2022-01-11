<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteApiController;
use App\Http\Controllers\ProductoApiController;
use App\Http\Controllers\VentaApiController;
use App\Http\Controllers\ProveedoresApiController;

use App\Http\Controllers\CompraApiController;
use App\Http\Controllers\ReportesApiController;
use App\Http\Controllers\PagoApiController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['prefix' => 'cliente'], function () {
    Route::get('get-clientes', [ClienteApiController::class, 'getAllClientes']);
    Route::post('add-cliente', [ClienteApiController::class, 'createNewClient']);
    Route::post('update-cliente', [ClienteApiController::class, 'UpdateCliente']);
    Route::post('delete-cliente/{id}', [ClienteApiController::class, 'deleteCliente']);
    

});
Route::group(['prefix' => 'proveedor'], function () {
    Route::get('get-proveedor', [ProveedoresApiController::class, 'getAllProveedores']);
    Route::post('add-proveedor', [ProveedoresApiController::class, 'createNewProveedor']);
    Route::post('update-proveedor', [ProveedoresApiController::class, 'UpdateProveedor']);
    Route::post('delete-proveedor/{id}', [ProveedoresApiController::class, 'deleteProveedor']);
    

});

Route::group(['prefix' => 'producto'], function () {
    Route::get('get-productos', [ProductoApiController::class, 'getAllProductos']);
    Route::post('add-producto', [ProductoApiController::class, 'createNewProducto']);
    Route::post('update-producto', [ProductoApiController::class, 'UpdateProducto']);
    Route::post('delete-producto/{id}', [ProductoApiController::class, 'deleteProducto']);
   

});

Route::group(['prefix' => 'pagos'], function () {
    Route::get('get-pagos-pendientes', [PagoApiController::class, 'PagosPendientes']);
    Route::post('delete-pago/{id}', [PagoApiController::class, 'deletePago']);
    Route::post('update-pago/{id}', [PagoApiController::class, 'cambioestadoPago']);
 
   

});

Route::group(['prefix' => 'compras'], function () {
    Route::get('get-informacion-header-compras/{comId} ', [CompraApiController::class, 'getInformacionHeaderCompras']);
    
    Route::get('get-compras', [CompraApiController::class, 'getCompras']);
    Route::post('create-nueva-compra', [CompraApiController::class, 'createNuevaCompra']);
    Route::post('update-compra', [CompraApiController::class, 'updateCompra']);
    Route::post('add-productos-compra', [CompraApiController::class, 'addProductosCompra']);
    Route::get('get-informacion-compra/{comId}',  [CompraApiController::class, 'getInformacionCompra']);
    Route::post('delete-compra/{id}', [CompraApiController::class, 'deleteCompra']);
    Route::post('delete-detalle-compra/{id}', [CompraApiController::class, 'deleteDetalleCompra']);
    Route::get('totales-dashboard-compras',  [CompraApiController::class, 'totalDashboardCompras']);
    Route::post('update-detalle_compra', [CompraApiController::class, 'updateDetalleCompra']);
});

Route::group(['prefix' => 'reportes'], function () {
    Route::get('reporte-ventas/{fechadesde}/{fechahasta}', [ReportesApiController::class, 'reporteVentas']);
    Route::get('reporte-por-cliente/{cliId}', [ReportesApiController::class, 'reporteVentasporCLiente']);
    Route::get('download-reporte-venta/{fechainicio}/{fechafinal} ',  [ReportesApiController::class, 'downloadReporteVenta']);
    Route::get('download-reporte-cliente/{cliId} ',  [ReportesApiController::class, 'downloadReporteCliente']);
    Route::get('reporte-compras/{fechadesde}/{fechahasta}', [ReportesApiController::class, 'reporteCompras']);
    Route::get('reporte-deudas-cliente/{cliId}', [ReportesApiController::class, 'reporteDeudasporCliente']);
    
  
});




Route::group(['prefix' => 'venta'], function () {
    Route::post('create-nueva-venta', [VentaApiController::class, 'createNuevaVenta']);
    Route::post('update-venta', [VentaApiController::class, 'updateVenta']);
    Route::post('registrar-abono', [VentaApiController::class, 'registrarabono']);
  
    Route::post('delete-retencion/{id}', [VentaApiController::class, 'deleteRetencion']);
 

    Route::post('create-detalle-venta', [VentaApiController::class, 'createDetalleVenta']);
    Route::get('get-informacion-venta/{venId}',  [VentaApiController::class, 'getInformacionVenta']);
    Route::post('delete-detalle-venta/{id}', [VentaApiController::class, 'deleteDetalleVenta']);
    Route::get('totales-venta/{venId}',  [VentaApiController::class, 'totalesVenta']);
    Route::get('download-venta/{venId}',  [VentaApiController::class, 'downloadVenta']);
    Route::get('get-informacion-pagos-venta/{venId}',  [VentaApiController::class, 'getInformacionPagosVenta']);
    Route::get('get-informacion-pagos-venta-abonos/{venId}',  [VentaApiController::class, 'getInformacionPagosVentaAbonos']);
    
    

    Route::get('get-detalle-general-venta/{venId}',  [VentaApiController::class, 'detalleGeneralVenta']);
    Route::get('get-detalle-venta',  [VentaApiController::class, 'detalleVenta']);
    Route::post('delete-venta/{id}', [VentaApiController::class, 'deleteVenta']);
   
    Route::post('update-observacion', [VentaApiController::class, 'UpdateObservacion']);
    Route::post('registrar-pago-contado', [VentaApiController::class, 'registrarPagoContado']);
    Route::post('registrar-pago-transferencia', [VentaApiController::class, 'registrarPagoTransferencia']);
    Route::post('registrar-pago-abono', [VentaApiController::class, 'registrarPagoAbono']);
    Route::post('registrar-pago-cheque', [VentaApiController::class, 'registrarPagoCheque']);
    Route::post('registrar-pago-credito', [VentaApiController::class, 'registrarPagoCredito']);
    
   
    Route::post('registrar-retencion', [VentaApiController::class, 'registrarRetencion']);
    Route::get('retencion-venta/{venId}',  [VentaApiController::class, 'retencionporventa']);
    Route::get('observacion-venta/{venId}',  [VentaApiController::class, 'observacionporventa']);
   

    Route::get('totales-dashboard-ventas',  [VentaApiController::class, 'totalDashboardVentas']);
    
    


    
        
    

});




