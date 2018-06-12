@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registro de usuarios</div>
                <div class="panel-body">
                    
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    @if (session('message'))
                        <div class="alert alert-success">
                             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('message') }}
                        </div>
                    @endif
                    
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Nombre*</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail*</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Contraseña*</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar Contraseña*</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label for="role" class="col-md-4 control-label">Rol*</label>

                            <div class="col-md-6">
                                <select class="form-control" name="role" id="role">
                                <option selected="true" disabled="disabled">-Seleccione un rol-</option>    
                                 
                                  <option>Super usuario</option>
                                  <option>Administrativo</option>
                                  <option>Aprobador</option>
                                  <option>Agente</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="role" class="col-md-4 control-label">Ciudad*</label>

                            <div class="col-md-6">
                                <select class="form-control" name="ciudad" id="ciudad">
                                <option selected="true" disabled="disabled">-Seleccione una ciudad-</option>    
                                <option>Bogotá</option>  
                                <option>Medellín</option>  
                                <option>Cali</option>  
                                <option>Barranquilla</option>  
                                <option>Cartagena de Indias</option>  
                                <option>Cúcuta</option>  
                                <option>Soledad</option>  
                                <option>Ibagué</option>  
                                <option>Bucaramanga</option>  
                                <option>Soacha</option>  
                                <option>Santa Marta</option>  
                                <option>Villavicencio</option>  
                                <option>Bello</option>  
                                <option>Pereira</option>  
                                <option>Valledupar</option>  
                                <option>Buenaventura</option>  
                                <option>Pasto</option>  
                                <option>Manizales</option>  
                                <option>Montería</option>  
                                <option>Neiva</option> 
                                </select>

                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Crear usuario
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
