<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'App\Http\Controllers\PageController@icons']);
		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'App\Http\Controllers\PageController@maps']);
		Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'App\Http\Controllers\PageController@notifications']);
		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'App\Http\Controllers\PageController@rtl']);
		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'App\Http\Controllers\PageController@tables']);
		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'App\Http\Controllers\PageController@typography']);
		Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'App\Http\Controllers\PageController@upgrade']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::get('cliente', ['as' => 'cliente.index', 'uses' => 'App\Http\Controllers\ClienteController@index']);
	Route::get('exportcliente', 'App\Http\Controllers\ClienteController@export')->name('export');
	Route::get('exportproducto', 'App\Http\Controllers\ProductoController@export')->name('export');



	Route::get('productos', ['as' => 'productos.index', 'uses' => 'App\Http\Controllers\ProductoController@index']);

	Route::get('proveedor', ['as' => 'proveedor.index', 'uses' => 'App\Http\Controllers\ProveedoresController@index']);
	Route::get('venta', ['as' => 'venta.index', 'uses' => 'App\Http\Controllers\VentaController@index']);
	Route::get('compra', ['as' => 'compra.index', 'uses' => 'App\Http\Controllers\CompraController@index']);
	Route::get('reporte', ['as' => 'reporte.index', 'uses' => 'App\Http\Controllers\ReportesController@index']);
	Route::get('reportecompras', ['as' => 'reporte.reportecompras', 'uses' => 'App\Http\Controllers\ReportesController@reportecompras']);
	
	Route::get('reportecliente', ['as' => 'reporte.reportecliente', 'uses' => 'App\Http\Controllers\ReportesController@reportecliente']);
	
	Route::get('ventapdf', ['as' => 'venta.ventapdf', 'uses' => 'App\Http\Controllers\VentaController@ventapdf']);
	Route::get('reporteventapdf', ['as' => 'reporte.reporteventapdf', 'uses' => 'App\Http\Controllers\ReportesController@reporteventas']);
	Route::get('reporteclientepdf', ['as' => 'reporte.reporteclientepdf', 'uses' => 'App\Http\Controllers\ReportesController@reporteclientepdf']);

	Route::get('nuevaventa', ['as' => 'venta.nuevaventa', 'uses' => 'App\Http\Controllers\VentaController@nuevaventa']);
	Route::get('editventa/{id} ', ['as' => 'venta.editventa', 'uses' => 'App\Http\Controllers\VentaController@editventa']);
	Route::get('editcompra/{id} ', ['as' => 'compra.editcompra', 'uses' => 'App\Http\Controllers\CompraController@editcompra']);
	Route::get('pago', ['as' => 'pago.index', 'uses' => 'App\Http\Controllers\PagoController@index']);
	
	
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});



Route::get('/facturaxml', 'App\Http\Controllers\VentaController@facturaxml')->name('facturaxml');


