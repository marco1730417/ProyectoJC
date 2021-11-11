<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteApiController;
use App\Http\Controllers\ProductoApiController;
use App\Http\Controllers\VentaApiController;



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

Route::group(['prefix' => 'producto'], function () {
    Route::get('get-productos', [ProductoApiController::class, 'getAllProductos']);
    Route::post('add-producto', [ProductoApiController::class, 'createNewProducto']);
    Route::post('update-producto', [ProductoApiController::class, 'UpdateProducto']);
    

});

Route::group(['prefix' => 'venta'], function () {
    Route::post('create-venta', [VentaApiController::class, 'createVenta']);
    Route::post('create-detalle-venta', [VentaApiController::class, 'createDetalleVenta']);
    Route::get('get-informacion-venta/{venId}',  [VentaApiController::class, 'getInformacionVenta']);
    Route::post('delete-detalle-venta/{id}', [VentaApiController::class, 'deleteDetalleVenta']);
    Route::get('totales-venta/{venId}',  [VentaApiController::class, 'totalesVenta']);
    Route::get('download-venta/{venId}',  [VentaApiController::class, 'downloadVenta']);
    
    Route::get('get-detalle-general-venta/{venId}',  [VentaApiController::class, 'detalleGeneralVenta']);
   
    


    
        
    

});




