


@extends('layouts.app', ['title' => __('Ventas')])

@section('content')
   
    <div id="app" >
   

    <edit-venta></edit-venta>

    </div>
        @include('layouts.footers.auth')
    </div>
@endsection