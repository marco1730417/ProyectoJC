@extends('layouts.pdf_layouts')

@section('styleCSS')

@endsection
<style>
       @page {
        size: A4 ;
        margin: 0.1%;
        font-size: 5pt;
        font-family: Arial, sans-serif !important;
    }
    @page :left {
        margin: 1mm;
    }

    @page :right {
        margin: 1mm;
    }
    body {
        padding-top: 110px;
        font-family: Arial, sans-serif !important;
        margin: 5px;
        font-size: 1.4rem !important;
        border: 2px solid rgb(241, 240, 240);
    }

    td {
        padding-left: 1px;
        padding-bottom: 3px;


    }

    th {
        font-weight: bold;

        padding-left: 4px;
        padding-bottom: 15px;

    }

    .column {
  float: left;
  width: 40%;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}


</style>
@section('content')

<div class="offset-xl-2 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 padding">
    <div class="card">

        <div class="card-body">
            <div class="row ">
  <div class="column">

    <p> <b> Nombre: </b> {{$info_venta[0]['nombre'] }} </p>
    <p> <b>Direccion: </b>  {{$info_venta[0]['direccion'] }} </p>
 
  </div>
  <div class="column"  >

  <p> <b>Ruc: </b>  {{$info_venta[0]['ruc'] }} </p>
   <p> <b>Telefono: </b>  {{$info_venta[0]['telefono'] }} </p>
    
  </div>
  <div class="column"  >

  <p> <b>Fecha </b>  {{$info_venta[0]['fecha'] }} </p> 
  
</div>

 


            </div>



            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Cod</th>
                        <th>Cant</th>
                        <th>Descripcion</th>
                        <th>Unidad</th>
                        <th  class="text-right ">Precio</th>
                     <!--    <th  class="text-right ">Desc</th> -->
                        <th  class="text-right ">Precio Total</th>
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
                            {{$item['uniPrecioVenta2']}}
                            @endif
                            @if ($item['opcion'] == 1)
                            {{$item['uniPrecioVenta1']}}
                            @endif
                            @if ($item['opcion'] == 3)
                            {{$item['uniPrecioVenta3']}}
                            @endif

                        </td>
                        <td class="text-right "><!-- {{$item['precioUnitario']}} -->
                        $@php echo(number_format($item['precioUnitario'],2));@endphp
                        </td>
                      <!--   <td class="text-right">
                        $@php echo(number_format($item['descuento'],2));@endphp
                        </td> -->
                        <td class="text-right"><!-- {{$item['subTotal']}} -->
                        $@php echo(number_format($item['subTotal'],2));@endphp
                      
                        </td>
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