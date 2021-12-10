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
            <div class="row ">

                <div class="col-sm-12 ">

                    <div class="d-inline p-2 "> <small>Razon Social {{$info_venta[0]['nombre'] }} </small> </div>
                    <div class="d-inline p-2 "> <small> Ruc:{{$info_venta[0]['ruc'] }}</small> </div> <br />
                    <div class="d-inline p-2 "> <small>Direccion:{{$info_venta[0]['direccion'] }} </small> </div>
                    <div class="d-inline p-2 "> <small>Fecha:{{$info_venta[0]['fecha'] }} </small> </div>
                    <div class="d-inline p-2 "> <small>Telf:{{$info_venta[0]['telefono'] }} </small> </div>
                </div>




            </div>



            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Cod</th>
                        <th>Cant</th>
                        <th>Descripcion</th>
                        <th>Unidad</th>
                        <th>Precio</th>
                        <th>Desc</th>
                        <th>PT</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detalle_venta as $item)
                    <tr>
                        <td>{{$item['nombre']}}</td>
                        <td class="center">{{$item['cantidad']}}</td>
                        <td class="left">{{$item['descripcion']}}</td>
                        <td class="left">

                            @if ($item['opcion'] == 2)
                            RL
                            @else
                            M
                            @endif



                        </td>
                        <td class="right ">{{$item['precioUnitario']}}</td>
                        <td class="right">{{$item['descuento']}}</td>
                        <td class="right">{{$item['subTotal']}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


            <div class="row">
       <!--      <div class="col-xs-6">
            <TABLE border="1"
>
Informacion Adicional
<tr>
    <th>Abono</th>
    <td>0</td>
  </tr>
  <tr>
    <th>Saldo</th>
    <td>0</td>
  </tr>

</TABLE>
            
</div> -->
            <div class="col-xs-6">

                <div class="col-lg-4 col-sm-5 ml-auto">
                    <table class="table table-clear">
                        <tbody>
                            <tr>
                                <td class="left">
                                    <strong>SUBTOTAL PRECIO</strong>
                                </td>
                                <td class="right">$@php echo(number_format($total_venta['subtotalprecio'],2));@endphp</td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong>DESCUENTO</strong>
                                </td>
                                <td class="right">$@php echo(number_format($total_venta['descuentos'],2));@endphp</td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong>SUBTOTAL SIN IMPUESTOS</strong>
                                </td>
                                <td class="right">$@php echo(number_format($total_venta['subtotal_sin_impuestos'],2));@endphp</td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong>VALOR IVA 12% </strong>
                                </td>
                                <td class="right">
                                    <strong>$@php echo(number_format($total_venta['valorIva'],2));@endphp</strong>
                                </td>

                            <tr>
                                <td class="left">
                                    <strong>VALOR TOTAL </strong>
                                </td>
                                <td class="right">
                                    <strong>$@php echo(number_format($total_venta['total'],2));@endphp</strong>
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