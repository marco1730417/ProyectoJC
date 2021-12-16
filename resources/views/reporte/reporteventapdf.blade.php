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




            </div>



            <table class="table table-striped">
                <thead>
                    <tr>
                    <th>#</th>
                     
                    <th>Cliente</th>
                        <th>Fecha</th>
                    
                    </tr>
                </thead>
                <tbody>
                @foreach ($info_venta as $item)
                    <tr>
                    <td>{{$item['id']}}</td>
                    <td>{{$item['nombre']}}</td>
                        <td class="center">{{$item['fecha']}}</td>
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
                              
                                <td class="right">$@php echo($contado_valor);@endphp</td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong>TOTAL TRANSFERENCIAS</strong>
                                </td>
                              
                                <td class="right">$@php echo($transferencia_valor);@endphp</td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong>TOTAL CHEQUES</strong>
                                </td>
                              
                                <td class="right">$@php echo($cheque_valor);@endphp</td>
                            </tr>
                    
                            <tr>
                                <td class="left">
                                    <strong>TOTAL ABONOS</strong>
                                </td>
                              
                                <td class="right">$@php echo($abono_valor);@endphp</td>
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