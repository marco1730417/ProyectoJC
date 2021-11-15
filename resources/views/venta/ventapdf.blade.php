


@extends('layouts.pdf_layouts')

@section('styleCSS')

@endsection
<style>

td {
        font-size: 7px;
       padding-left: 5px;
        padding-bottom: 3px;

           
      }
      th {
        font-size: 10px;
        font-weight: bold;
       
       padding-left: 1px;
        padding-bottom: 3px;

           
      }

.padding {
    padding: 5rem !important
}

.card {
    margin-bottom: 20px;
    border: none;
    -webkit-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
    -moz-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
    box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22)
}

.card-header {
    background-color: #fff;
    border-bottom: 1px solid #e6e6f2
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

.text-dark {
   
    font-size: 8px;
}


    
    </style>
@section('content')
<div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
     <div class="card">
   
         <div class="card-body">
             <div class="row mb-4">
   
                 <div class="col-sm-6 ">
                     <h5 class="text-dark mb-1">Cliente :  {{$info_venta[0]['nombre'] }}</h5>
                     <h5 class="text-dark mb-1">Ruc:  {{$info_venta[0]['ruc'] }}</h5>
                     <h5 class="text-dark mb-1">Direccion: {{$info_venta[0]['direccion'] }}</h5>
                     <h5 class="text-dark mb-1">Fecha: {{$info_venta[0]['fecha'] }}</h5>
                     
                  
                 </div>
         
            
             </div>
             <div class="table-responsive-sm">
                 <table class="table table-striped">
                     <thead>
                         <tr>
                             <th>Codigo</th>
                             <th>Descripcion</th>
                             <th class="right">Precio Uni</th>
                             <th class="center">Cantidad</th>
                             <th class="right">Total</th>
                         </tr>
                     </thead>
                     <tbody>
                     @foreach ($detalle_venta as $item)  
                         <tr>
                             <td >{{$item['nombre']}}</td>
                             <td class="left">{{$item['descripcion']}}</td>
                             <td class="right">{{$item['precioUnitario']}}</td>
                             <td class="center">{{$item['cantidad']}}</td>
                             <td class="right">{{$item['subTotal']}}</td>
                         </tr>
                         @endforeach
                     </tbody>
                 </table>
             </div>
             <div class="row">
                 <div class="col-md-4 col-sm-5">
                 </div>
                 <div class="col-md-4 col-sm-5 ml-auto">
                  <table class="table table-clear">
                         <tbody>
                             <tr>
                                 <td >
                                     <h5 class="text-dark">Subtotal        </h5>
                                 </td>
                                 <td class="right"><strong class="text-dark"> $ @php echo(number_format($total_venta['subtotal'],2));@endphp</strong></td>
                             </tr>
                        
                             <tr>
                                 <td >
                                 <h5 class="text-dark">Iva  @php echo(number_format($total_venta['iva'],2));@endphp %</h5>
                                 </td>
                                 <td class="right">   <strong class="text-dark"> $ @php echo(number_format($total_venta['valorIva'],2));@endphp</strong></td>
                             </tr>
                             <tr>
                                 <td >
                                     <strong class="text-dark">Total</strong> </td>
                                 <td class="right">
                                     <strong class="text-dark">$           @php echo(number_format($total_venta['total'],2));@endphp</strong>
                                 </td>
                             </tr>
                         </tbody>
                     </table> 
           
                 </div>
             </div>
         </div>

     </div>
 </div>
@endsection