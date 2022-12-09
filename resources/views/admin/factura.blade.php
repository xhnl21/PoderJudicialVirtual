@extends('adminlte::page')

@section('title', 'Productos')

@section('content')
<div class="container">
      <div class="container">      
        <table class="table">
          <thead>
            <tr>
            <th scope="col">Cliente</th>
              <th scope="col">Producto</th>
              <th scope="col">Precio</th>
              <th scope="col">Impuesto</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @if (count($producto) > 0)
              @foreach ($producto as $in)  
                <tr>
                  <th>{{ $in['cliente'] }}</th>
                  <td>{{ $in['cantidad_producto'] }}</td>
                  <td>{{ number_format($in['precio_total_producto'], 2, ',', '.') }}$</td>
                  <td>{{ number_format($in['impuesto_total_producto'], 2, ',', '.') }}%</td>
                  <td>
                    <a class="btn btn-info" href="{{ url('admin/createPDFD/'.$in['user_id']) }}" target="_blank">PDF </a>
                  </td>
                </tr>                 							
              @endforeach	
            @else
              <tr>
                <td colspan="5">
                  <div style="text-align: center">
                    No hay Productos
                  </div>
                </td>
              </tr>        
            @endif           
          </tbody>
        </table>        
      </div> 
</div>
@stop

@section('css')

@stop

@section('js')

@stop
