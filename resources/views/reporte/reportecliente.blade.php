


@extends('layouts.app', ['title' => __('Reportes')])

@section('content')
   
    <div id="app" >
        <reporte-clientes></reporte-clientes> 
    </div>
        @include('layouts.footers.auth')
    </div>
@endsection