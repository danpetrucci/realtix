@extends('layouts.app')

@section('content')
<div class="container" >
    <div class="row">
        <form role="form" method="GET" action="{{ url('/user/search/') }}">
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
    	<th>#</th>
    	<th>Nombre</th>
        <th>Rol</th>
    	<th>Teléfono</th>
    	<th>Inmobiliaria</th>
        <th>Ciudad</th>
    	<th>Creado el</th>
        <th>Estatus</th>
        <th>Editar</th>
        <th>Borrar</th>
    </tr>

    <?php
        $i=1;
    ?>
    @foreach ($users as $user)
    <tr>
        <td>{{ $i }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->role }}</td>
        <td>{{ $user->telefono }}</td>        
        <td>{{$user->inmobiliaria['nombre']}}</td> 	
        <td>{{ $user->ciudad }}</td>
        <td>{{ substr($user->created_at,0,-8) }}</td>
        <td>@if($user->status=="0") <span style="color:red;">Inactivo</span> 
        @else <span style="color:green;">Activo</span> @endif</td>
        <td>
            <form role="form" method="GET" action="{{ url('/user/edit/'.$user->id) }}">
            <button class="btn btn-default" type="submit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
            </form>
        </td>
        <td>
        <form role="form" method="POST" action="{{ url('/user/destroy/'.$user->id) }}">
        {{ csrf_field() }}
            <button class="btn btn-default" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
        </form>
        </td>
        
    </tr>
        <?php
        $i=$i+1;
        ?>
    @endforeach 
    </table>  
    </div>

    @if($totalusers!="")
    <p>Usuarios registrados: {{$totalusers}}.</p>
    @endif

    @if($countsearch!="")
        <p>Usuarios encontrados: {{$countsearch}}.
        <a href="{{url('/user')}}">
            <div class="col-md-6 col-md-offset-5">
                <button type="button" class="btn btn-primary">
                    Regresar 
                </button>
            </div>
        </a>
        </p>
    @endif

    @if(($countsearch==0)&($totalusers==""))
        <p>Usuarios encontrados: 0.
        <a href="{{url('/user')}}">
            <div class="col-md-6 col-md-offset-5">
                <button type="button" class="btn btn-primary">
                    Regresar 
                </button>
            </div>
        </a>
        </p>
    @endif


    {{ $users->links() }}
    
    </div>
</div>

@endsection
