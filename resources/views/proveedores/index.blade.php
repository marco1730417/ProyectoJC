


@extends('layouts.app', ['title' => __('Proveedores')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Modulo Proveedores'),
    ])   

    <div id="app" >
       <proveedores></proveedores>
    </div>
        @include('layouts.footers.auth')
    </div>
@endsection