@extends('layouts.app')

@section('content')
<div class="container" >
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Panel de inicio</div>

                <div class="panel-body">
                    Bienvenido/a, <strong>{{Auth::user()->name}}</strong> usted está conectado a la plataforma como <strong>{{Auth::user()->role}}</strong>.
                    <br><br>
                    Por favor utilice el menú en la barra superior para navegar entre las opciones <br> disponibles según su <strong>rol asignado.</strong> 
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
