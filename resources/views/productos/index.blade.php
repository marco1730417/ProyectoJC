


@extends('layouts.app', ['title' => __('Productos')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Productos'),
    ])   

    <div id="app" >
        <productos></productos> 
    </div>
        @include('layouts.footers.auth')
    </div>
@endsection