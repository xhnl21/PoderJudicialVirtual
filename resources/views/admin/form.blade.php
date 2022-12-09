@extends('adminlte::page')

@section('title', 'Productos')

@section('content')
<div class="container">
    <div class="container">
        <form method="post"  id="basicform" action="{{ url('admin/crear') }}">
            @csrf
            <div class="custom-form">
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label for="name">Nombre</label>
                        <input type="text" name="name"  id="name" class="form-control" value="{{ $producto->name ?? '' }}">
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="precio">Precio</label>
                        <input type="text" name="precio"  id="precio" class="form-control" value="{{ $producto->precio ?? '' }}">
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="impuesto">Impuesto</label>
                        <input type="text" name="impuesto"  id="impuesto" class="form-control" value="{{ $producto->impuesto ?? '' }}">
                        <input type="hidden" name="id"  id="id" value="{{ $producto->id ?? 0 }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary" style="float: right;" type="submit">Guardar</button>
                    </div>
                </div>                
            </div>
        </form>						
    </div> 
</div>
@stop

@section('css')

@stop

@section('js')

@stop
