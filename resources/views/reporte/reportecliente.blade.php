


@extends('layouts.app', ['title' => __('Reportes')])

@section('content')
   
    <div id="app" >
        <reporte-cliente></reporte-cliente> 
    </div>
        @include('layouts.footers.auth')
    </div>
@endsection