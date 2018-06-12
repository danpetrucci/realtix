@extends('layouts.app')

@section('content')
<div class="container" >
    <div class="row">
        <form role="form" method="POST" action="{{ url('/inmobiliaria/search') }}">
        {{ csrf_field() }}
        <div class="col-md-3 col-md-offset-9">
            <div class="input-group stylish-input-group">
                    <input type="text" class="form-control" name="keyword"  placeholder="Buscar.." >
                    <span class="input-group-addon">
                        <button type="submit">
                             <i class="fa fa-search" aria-hidden="true"></i>
                        </button>  
                    </span>
                </div>
        </div>
        </form>
    </div>
    @if (session('message'))
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-success" style="margin-top: 5px;">
                             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('message') }}
                        </div>
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-danger" style="margin-top: 5px;">
                             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('error') }}
                        </div>
                    </div>
                </div>
            @endif
    
    <br>
    <div class="row">
    <div class="table-responsive">
    <table class="table">
    <tr>
    	<th>Id</th>
    	<th>Inmobiliaria</th>
        <th>Nit</th>
        <th>Pais</th>
        <th>Departamento</th>
        <th>Ciudad</th>
        <th>Dirección</th>
        <th>Teléfono</th>
    	<th>Creada el</th>
    	<th>Editar</th>
        <th>Borrar</th>
    </tr>
    @foreach ($todas_inmobiliarias as $inmo)
    <tr>
        <td>{{ $inmo->id }}</td>
        <td>{{ $inmo->nombre }}</td>
        <td>{{ $inmo->nit }}</td>
        <td>{{ $inmo->pais_inmo }}</td>
        <td>{{ $inmo->departamento_inmo }}</td>
        <td>{{ $inmo->ciudad_inmo }}</td>
        <td>{{ $inmo->direccion }}</td>
        <td>{{ $inmo->telefono }}</td>        
        <td>{{ substr($inmo->created_at,0,-8) }}</td>
        <td>
        <form role="form" method="GET" action="{{ url('/inmobiliaria/'.$inmo->id.'/edit') }}">
            <button class="btn btn-default" type="submit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
        </form>
        </td>
        <td>
        <form role="form" method="POST" action="{{ url('/inmobiliaria/'.$inmo->id) }}">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
            <button class="btn btn-default" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
        </form>
        </td>
    </tr>
    @endforeach 
    </table>  
    </div>
    <p>Inmobiliarias Registradas: {{$total_inmobiliarias}}.</p>
    {{ $todas_inmobiliarias->links() }}
    
    </div>
</div>

@endsection
