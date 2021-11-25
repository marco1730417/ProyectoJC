


@extends('layouts.app', ['title' => __('Compras')])

@section('content')
   
    <div id="app" >
        <compras></compras> 
    </div>
        @include('layouts.footers.auth')
    </div>
@endsection