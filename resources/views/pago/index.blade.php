


@extends('layouts.app', ['title' => __('Pagos Pendientes')])

@section('content')
   
    <div id="app" >
        <pagos-pendientes></pagos-pendientes> 
    </div>
        @include('layouts.footers.auth')
    </div>
@endsection