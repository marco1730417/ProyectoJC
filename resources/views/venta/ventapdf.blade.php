


@extends('layouts.pdf_layouts')

@section('styleCSS')

@endsection
<style type = "text/css">

table {
            width: 100%;
            max-width: 100%;
            border-collapse: collapse;
        }

        .table.producto tr{
            border: none;
        }

        .table.producto th{
            padding: 0.2rem;
            border-bottom: 1px solid #dee2e6;
            border-top: 1px solid #dee2e6;
            text-align: center;
            vertical-align: middle;
        }
        .table.producto td{
            padding: 0.2rem;
            vertical-align: middle;
            border-top: 1px solid #dee2e6;
            border-bottom: 1px solid #dee2e6;
        }


  .table.producto, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}

        .table.prices td, .table.prices th {
            padding: 0.3rem 0.2rem 0.3rem;
            border-top: none;
            text-align: right;
            padding-right: 0.4rem;
        }

    </style>
@section('content')
<div class="container">
 


<div class="table-responsive-sm">
  <table class="table head" nocollapse="" sort-desc.sync="false" role="table" aria-busy="false" aria-colcount="7" class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div><small class="font-weight-bold">Nombre </small>{{$info_venta[0]['nombre'] }}</div> 
                                            <div><small class="font-weight-bold">Direccion </small>{{$info_venta[0]['direccion'] }}</div> 
                                    
                                        </td>
                                        <td>
                                            <div><small class="font-weight-bold">Ruc</small> {{$info_venta[0]['ruc'] }}</div>
                                            <div><small class="font-weight-bold">Fecha</small> 
                                            {{$info_venta[0]['fecha'] }}
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
  
  <table class="table producto ">
    <thead>
      <tr>
        <th>Codigo</th>
        <th>Descripcion</th>
        <th>Cantidad</th>
        <th>Precio Unitario</th>
        <th>Sub Total</th>
        
      </tr>
    </thead>
    <tbody>
    @foreach ($detalle_venta as $item)  
                                  
      <tr>
        <td height="7">{{$item['nombre']}}</td>
        <td height="7">{{$item['descripcion']}}</td>
        <td height="7">{{$item['cantidad']}}</td>
        <td height="7">{{$item['precioUnitario']}}</td>
        <td height="7">{{$item['subTotal']}}</td>
      </tr>
      @endforeach

    </tbody>
  </table>
  <div class="quote-pdf-tableBg">
            <table nocollapse="" sort-desc.sync="false" role="table" aria-busy="false" aria-colcount="7" class="table prices">
                    <tr>
                        <td width="72.5%">&nbsp;</td>
                        <td class="quote-pdf-headerRight" width="27.5%">
                            <table nocollapse="" sort-desc.sync="false" role="table" aria-busy="false" aria-colcount="7" class="table prices">
                                <tbody role="rowgroup">
                                    <tr>
                                        <td width="50%">
                                            Sub Total
                                        </td>
                                        <td width="50%">
                                            @php echo(number_format($total_venta['subtotal'],2));@endphp
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%">
                                           IVA @php echo(number_format($total_venta['iva'],2));@endphp %
                                        </td>
                                        <td width="50%">
                                            @php echo(number_format($total_venta['valorIva'],2));@endphp
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%">
                                            Total
                                        </td>
                                        <td width="50%">
                                            @php echo(number_format($total_venta['total'],2));@endphp
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
              
            </table>
        </div>
  </div>
</div>

@endsection