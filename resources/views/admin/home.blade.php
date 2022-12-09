@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="container">
  @if(Auth::user()->id != 1 && Auth::user()->id != 2)
      @if(!empty($msj))
        <div class="alert alert-primary" role="alert">
          {{$msj}}
        </div>
      @endif 
      <div class="container">
        @if (count($producto) > 0)
          <form method="post"  id="basicform" action="{{ url('admin/comprar') }}">
            @csrf
            <div class="custom-form">
              <div class="row">
                @foreach ($producto as $in)
                <div class="form-group col-lg-6">
                  <label for="producto_id-{{ $in['id'] }}">
                    Producto: {{ $in['name'] }} Precio: {{ number_format($in['precio'], 2, ',', '.') }}$  Impuesto: {{ number_format($in['impuesto'], 2, ',', '.') }}%
                  </label>                
                  <input type="checkbox" name="producto_id[]" id="producto_id-{{ $in['id'] }}" value="{{ $in['id'] }}">
                </div>    							
                @endforeach	
              </div>
              <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                  <button class="btn btn-warning" type="submit" style="float: right;">Comprar</button>
                </div>     
              </div> 
            </div>
          </form>							
        @else
          <div class="custom-form">
            <div style="text-align: center">
              No hay Productos
            </div>										
          </div>
        @endif 
    </div> 
  @endif
</div>
@stop

@section('css')

@stop

@section('js')

@stop
