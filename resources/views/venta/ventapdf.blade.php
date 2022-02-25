@extends('layouts.pdf_layouts')

@section('styleCSS')

@endsection
<style>
       @page {
        size: 210mm 150 landscape ;
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
        font-family: Arial, sans-serif !important;
        margin: 5px;
        font-size: 1.5rem !important;
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

    .content_f{
        width: 100%;
        height:100%;
    }
    .column {
  float: left;
  width: 40%;
  margin-left: 15px;
}
.column1 {
    float: left;
    width: 40%;
    margin-right: 15px;
    }

.row:after {
  content: "";
  display: table;
  clear: both;

}



@media print {
    .content_f{
        width: 100%;
        height:100%;
    }
    .column {
    float: left;
    width: 40%;
    margin-left: 15px;
    }
    .column1 {
    float: left;
    width: 40%;
    margin-right: 15px;
    }


    .row:after {
    content: "";
    display: table;
    clear: both;
    }
    body {
        padding-top: 75px;
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
}

</style>
@section('content')

<div class="content_f">
    <div class="card">

        <div class="card-body">
            <div class="row ">
  <div class="column">

    <p> <b> Nombre: </b> {{$info_venta[0]['nombre'] }} </p>
    <p> <b>Dirección: </b>  {{$info_venta[0]['direccion'] }} </p>
 
  </div>
  <div class="column"  >

  <p> <b>Ruc: </b>  {{$info_venta[0]['ruc'] }} </p>
   <p> <b>Teléfono: </b>  {{$info_venta[0]['telefono'] }} </p>
    
  </div>
  <div class="column1"  >

  <p> <b>Fecha </b>  {{$info_venta[0]['fecha'] }} </p> 
  
</div>

 


            </div>



            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Cod</th>
                        <th>Cant</th>
                        <th>Descripción</th>
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
         
            <div class="col-xs-6 col-md-4">
            @if ($detallepago[0]['tipo'] )  
<div class="card  border-primary" >
<p class="card-header" >  <b> Información Adicional</b></p>
</div> @endif
@if ($detallepago[0]['tipo'] )  
<table class="table table-striped">
  <tbody>
  <tr>
      <th>Forma de pago</th>
      <td>{{$detallepago[0]['tipo']}}</td>
    </tr>
    @if ($detallepago[0]['tipo'] == 'Abono' ||$detallepago[0]['tipo'] == 'Credito' )
    <tr>
      <th>Fecha de vencimiento</th>
      <td>{{$detallepago[0]['fechamaxima']}}</td>
    </tr>
    @endif
    @if ($info_venta[0]['email']  )  
    <tr>
      <th>Email</th>
      <td>{{$info_venta[0]['email'] }} </td>
    </tr>

@endif
@if ($detallepago[0]['tipo'] == 'Abono' )
    <tr>
      <th>Abono</th>
      <td>
      $@php echo(number_format($detallepago[0]['abono'],2));@endphp
          
    </td>
    </tr>
    <tr>
      <th>Saldo</th>
      <td>
          
      $@php echo(number_format($detallepago[0]['saldos'],2));@endphp
    
    </td>
    </tr>
    @endif
  </tbody>
</table>
@endif
</div>
     
            <div class="col-xs-6">

                <div class="col-lg-6 col-sm-3 ml-auto">
                    <table  class="table table-clear">
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