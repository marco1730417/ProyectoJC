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
<!--     <div class="card">
        <div class="card-body">
            <h67 class="card-title">REPORTE DE VENTAS</h6> <br>
                <small class="card-text">Fecha Inicio: @php echo($start_date);@endphp </small>
                <small class="card-text">Fecha Final: @php echo($end_date);@endphp </small>

        </div>
    </div> -->

    <div class="card">

        <div class="card-body">
            <div class="row ">


            </div>
            <h6 class="text-center">REPORTE DE VENTAS</h6>
                <small class="text-center">Fecha Inicio: @php echo($start_date);@endphp </small>
                <small class="text-center">Fecha Final: @php echo($end_date);@endphp </small>  <br> <br>

            <h6 class="text-center">DETALLE DE VENTAS REALIZADAS</h6> <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>

                        <th>Cliente</th>
                        <th>Fecha Venta</th>
                        <th>Tipo</th>
                        <th>Abono</th>
                        <th>Saldo</th>
                        <th>Fecha máxima</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($info_venta as $item)
                    <tr>
                        <td>{{$item['id']}}</td>
                        <td>{{$item['nombre']}}</td>
                        <td class="center">{{$item['fecha']}}</td>
                        <td class="center">{{$item['tipo']}}</td>

                        <td>
                            $@php echo(number_format($item['abono'],2));@endphp
                        </td>
                        @if ($item['saldos']> 0)
                        <td>
                            $@php echo(number_format($item['saldos'],2));@endphp
                        </td>
                        @endif
                        @if ($item['saldos'] <= 0) <td>0</td> @endif

                            @if ($item['fechamaxima'])

                            <td class="center">{{$item['fechamaxima']}}</td> @endif
                            @if ($item['fechamaxima'] == null)

                            <td class="center">N/A</td> @endif


                            <td>
                                $@php echo(number_format($item['total'],2));@endphp
                            </td>
                    </tr>



                    @endforeach
                </tbody>
            </table> <br>
            <h6 class="text-center">ABONOS REALIZADOS A VENTAS DE CRÉDITO O ABONOS</h6> <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tipo</th>

                        <th>Cliente</th>
                        <th>Fecha Pago</th>
                        <th>Método</th>
                        <th>Abono</th>
                        <th>Detalle</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($valores_abonos as $item)
                    <tr>
                        <td>{{$item['id']}}</td>
                        <td>{{$item['tipo']}}</td>

                        <td>{{$item['nombre']}}</td>
                        <td class="center">{{$item['fecha']}}</td>

                        @if ($item['tipoabono']== 1)
                        <td class="center">Efectivo</td>
                        @endif
                        @if ($item['tipoabono']== 2)
                        <td class="center">Transferencia</td>
                        @endif
                        @if ($item['tipoabono']== 3)
                        <td class="center">Cheque</td>
                        @endif
                        <td>
                            $@php echo(number_format($item['abono'],2));@endphp
                        </td>

                        <td class="center">{{$item['detalleabono']}}</td>


                    </tr>



                    @endforeach
                </tbody>
            </table>


            <div class="row">

                <div class="col-xs-6">

                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong>TOTAL CONTADO</strong>
                                    </td>

                                    <td class="right">


                                        $@php echo(number_format($contado_valor,2));@endphp
                                    </td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>TOTAL TRANSFERENCIAS</strong>
                                    </td>

                                    <td class="right">

                                        $@php echo(number_format($transferencia_valor,2));@endphp

                                    </td>
                                </tr>


                                <tr>
                                    <td class="left">
                                        <strong>TOTAL ABONOS</strong>
                                    </td>

                                    <td class="right">
                                        $@php echo(number_format($abono_valor,2));@endphp


                                    </td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>TOTAL CHEQUES</strong>
                                    </td>

                                    <td class="right">
                                        $@php echo(number_format($cheque_valor,2));@endphp

                                    </td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>TOTAL CRÉDITOS</strong>
                                    </td>

                                    <td class="right">
                                        $@php echo(number_format($credito_valor,2));@endphp

                                    </td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>ABONOS A VENTAS TIPO CREDITO</strong>
                                    </td>

                                    <td class="right">
                                        $@php echo(number_format($abonos_credito_total,2));@endphp

                                    </td>
                                </tr>


                                <tr>
                                    <td class="left">
                                        <strong>ABONOS A VENTAS TIPO ABONO</strong>
                                    </td>

                                    <td class="right">
                                        $@php echo(number_format($abonos_abono_total,2));@endphp

                                    </td>
                                </tr>


                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection