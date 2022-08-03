@extends('layouts.pdf_layouts')

@section('styleCSS')

@endsection
<style>
    td {
        font-size: 7px;
        padding-left: 1px;
        padding-bottom: 3px;


    }

    th {
        font-size: 10px;
        font-weight: bold;

        padding-left: 4px;
        padding-bottom: 15px;

    }

    .padding {
        padding: 3rem !important
    }

    .card {
        width: 700px !important;
        margin-bottom: 50px;
        border: none;
        -webkit-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
        -moz-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
        box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22)
    }


    h3 {
        font-size: 10px
    }

    h5 {
        font-size: 7px;
        line-height: 10px;
        color: #3d405c;
        margin: 0px 0px 15px 0px;
        font-family: 'Circular Std Medium'
    }

    small {
        font-size: 5px;

        font-family: 'Circular Std Medium'
    }

    .text-dark {

        font-size: 8px;
    }
</style>
@section('content')
<div class="offset-xl-2 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 padding">
    <div class="card">

        <div class="card-body">


            <h6 class="text-center">REPORTE CLIENTE:  {{$ventas_cliente[0]['nombre']}} </h6>
            
            <h6 class="text-center">VENTAS NO ADEUDADAS </h6> <br>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Detalle</th>
                        
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Total</th>
                    
                    </tr>
                </thead>
                <tbody>
                @foreach ($ventas_cliente as $item)
                    <tr>
                    <td>{{$item['venId']}}</td>
                     
                    
                        @if ($item['tipo']== 'Contado')
                        <td class="center">{{$item['detallecontado']}}  </td>
                        @endif
                        @if ($item['tipo']== 'Transferencia')
                        <td class="center">{{$item['numtransf']}}  </td>
                        @endif
                        @if ($item['tipo']== 'Credito')
                        <td class="center">{{$item['cheque']}}  </td>
                        @endif
                        @if ($item['tipo']== 'Abono')
                        <td class="center">{{$item['detalleabono']}}  </td>
                        @endif
                        @if ($item['tipo']== 'Cheque')
                        <td class="center">{{$item['cheque']}}  </td>
                        @endif
                       




                    <td>{{$item['fecha']}}</td>
                    <td>{{$item['tipo']}}</td>
                    <td>  $@php echo(number_format($item['total'],2));@endphp</td>
                    
                   
                    </tr>
                    
                    @endforeach
                </tbody>
            </table>

<br>
            <h6 class="text-center"> VENTAS ADEUDADAS $@php echo(number_format($total_deuda,2));@endphp </h6> <br>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Saldo</th>
                    
                    </tr>
                </thead>
                <tbody>
                @foreach ($ventas_deuda as $venta)
                    <tr>
                    <td>{{$venta['venId']}}</td>
                    <td>{{$venta['fecha']}}</td>
                    <td>{{$venta['tipo']}}</td>
                    <td>  $@php echo(number_format($venta['saldos'],2));@endphp</td>
                   
                    </tr>
                    
                    @endforeach
                </tbody>
            </table>


       

        </div>

    </div>
</div>
@endsection