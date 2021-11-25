


@extends('layouts.app', ['title' => __('Compras')])

@section('content')
   
    <div id="app" >
   

    <edit-compra></edit-compra>

    </div>
        @include('layouts.footers.auth')
    </div>
@endsection