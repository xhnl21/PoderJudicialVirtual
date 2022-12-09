@extends('adminlte::page')

@section('title', 'Productos')

@section('content')
<div class="container">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <a class="btn btn-primary" href="{{ url('admin/form') }}" style="float: left;">Agregar </a> 
          </div>   
          <div class="col-md-6"></div>  
        </div>         
        <br>
        <table class="table">
          <thead>
            <tr>
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
                  <th>{{ $in['name'] }}</th>
                  <td>{{ number_format($in['precio'], 2, ',', '.') }}$</td>
                  <td>{{ number_format($in['impuesto'], 2, ',', '.') }}%</td>
                  <td>
                    <a class="btn btn-warning" href="{{ url('admin/form/'.$in['id']) }}">Editar </a>
                    <a class="btn btn-danger" href="{{ url('admin/destroy/'.$in['id']) }}">Eliminar </a>
                    <!-- <a class="btn btn-info" href="{{ url('admin/createPDF/'.$in['id']) }}">Eliminar </a> -->
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
