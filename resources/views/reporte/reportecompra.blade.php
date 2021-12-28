


@extends('layouts.app', ['title' => __('Reportes')])

@section('content')
   
    <div id="app" >
        <reporte-compra></reporte-compra> 
    </div>
        @include('layouts.footers.auth')
    </div>
@endsection