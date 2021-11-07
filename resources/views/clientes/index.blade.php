


@extends('layouts.app', ['title' => __('Clientes')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Modulo Clientes'),
    ])   

    <div id="app" >
       <clientes></clientes>
    </div>
        @include('layouts.footers.auth')
    </div>
@endsection