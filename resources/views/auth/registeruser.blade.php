@extends('layouts.app')

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
                    
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/store') }}" enctype="multipart/form-data">
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
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar contraseña*</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="role" class="col-md-4 control-label">Ciudad*</label>

                            <div class="col-md-6">
                                <select class="form-control chosen-select" name="ciudad">
                                <option selected="true" disabled="disabled">-Seleccione una ciudad-</option>    
                                @foreach ($ciudades as $ciudad)
                                    <option>{{$ciudad}}</option>
                                @endforeach
                                </select>

                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="teléfono" class="col-md-4 control-label">Teléfono*</label>

                            <div class="col-md-6">
                                <input id="tel" type="text" class="form-control" name="teléfono" value="{{ old('teléfono') }}" autofocus maxlength="13">
                            </div>
                        </div>
                        
                       <div class="form-group">
                              <label class="col-md-4 control-label">Foto de perfil:</label>
                              <div class="col-md-6">
                                <input type="file" class="form-control" name="foto">
                                <p>Tamaño máximo: 5MB. Foto cuadrada.</p>
                              </div>
                        </div>
                        @if(Auth::user()->role=="Super usuario")
                        <div class="form-group">
                            <label for="inmobiliaria" class="col-md-4 control-label">Inmobiliaria*</label>

                            <div class="col-md-6">
                                <select class="form-control" name="inmobiliaria">
                                <option selected="true" disabled="disabled">-Seleccione una inmobiliaria-</option>    
                                @foreach($inmobiliarias as $inmobiliaria)
                                    <option value="{{$inmobiliaria->id}}">{{$inmobiliaria->nombre}}</option>
                                @endforeach   
                                </select>

                            </div>
                        </div>
                        @endif
                        
                            <div class="form-group">
                            <label for="role" class="col-md-4 control-label">Rol*</label>

                            <div class="col-md-6">
                                <select class="form-control" name="rol">
                                <option selected="true" disabled="disabled">-Seleccione un rol-</option> 
                                @if (Auth::user()->role=="Super usuario")
                                    @foreach ($roles as $role)
                                    <option>{{$role}}</option>
                                    @endforeach
                                @else
                                    <option>{{$roles[1]}}</option>
                                    <option>{{$roles[2]}}</option>
                                    <option>{{$roles[3]}}</option>
                                @endif
                                </select>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                              <label class="col-md-4 control-label"></label>
                            <div class="col-md-6">
                            <p>*Campos obligatorios.</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Crear 
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
