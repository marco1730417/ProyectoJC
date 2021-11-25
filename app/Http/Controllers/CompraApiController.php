<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\ApiResponseController;
use App\Models\Compras;
use App\Models\DetalleCompras;
use App\Models\Proveedores;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Pagination\PaginationState;
use Illuminate\Support\Facades\Config;
use PDF
 ;

class CompraApiController extends ApiResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
/* 
     api que trae todo el datalle de compras incluido los productos */

    public function getInformacionCompras()
    {
        $detalle_compras = Compras:: select('compras.fecha','compras.total','compras.valoriva','compras.comprobante','detalle_compras.cantidad','detalle_compras.precio','detalle_compras.proId',
        'productos.nombre','productos.descripcion','proveedores.nombre','proveedores.ruc','proveedores.telefono','proveedores.email'
        ) 
        ->leftJoin('detalle_compras', 'compras.id', '=', 'detalle_compras.comId')
            ->leftJoin('proveedores', 'compras.prvId', '=', 'proveedores.id')
            ->leftJoin('productos', 'detalle_compras.proId', '=', 'productos.id')->get();

        return $this->successResponse($detalle_compras);
    }
/* 
    api que trae las compras con sus detalles basicos */
    public function getCompras()
    {
        $compras = Compras:: select('compras.fecha','compras.total','compras.valoriva','compras.comprobante'
        ,'proveedores.nombre','proveedores.ruc','proveedores.telefono','proveedores.email'
        ) 

            ->leftJoin('proveedores', 'compras.prvId', '=', 'proveedores.id')->get();
       
        return $this->successResponse($compras);
    }

    /* 
    crear una compra */
    public function createNuevaCompra()
    {
        
        $new_compra = new Compras;
        
        $new_compra->save();

        if (!$new_compra) return $this->errorResponse(500);

        return $this->successResponse($new_compra->id);
    }
  
    }



