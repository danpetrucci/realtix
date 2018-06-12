@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edición de usuario</div>
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
                            {{ session('message') }} <a href="{{url('/user/edit/'.$user->id)}}">Refrescar la foto.</a>
                        </div>
                    @endif

                    @if (file_exists (public_path('storage/avatars/'.$user->id.'.jpeg')))
                        <img class="img-responsive avatarbig" src="{{asset('storage/avatars/'.$user->id.'.jpeg')}}">
                        @else
                        <img class="img-responsive avatarbig" src="/storage/avatars/generic-avatar.png">
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/update') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="userid" value="{{ $user->id }}">

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Nombre*</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail*</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}">
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <label for="role" class="col-md-4 control-label">Ciudad*</label>

                            <div class="col-md-6">
                                <select class="form-control chosen-select" name="ciudad">
                                <option selected="true" disabled="disabled">-Seleccione una ciudad-</option>    
                                @foreach ($ciudades as $ciudad)
                                    <option @if($user->ciudad==$ciudad) selected="true" @endif>{{$ciudad}}</option>
                                @endforeach
                                </select>

                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="teléfono" class="col-md-4 control-label">Teléfono</label>

                            <div class="col-md-6">
                                <input id="tel" type="text" class="form-control" name="teléfono" value="{{ $user->telefono }}" autofocus maxlength="13">
                            </div>
                        </div>
                        
                       <div class="form-group">
                              <label class="col-md-4 control-label">Foto de perfil:</label>
                              <div class="col-md-6">
                                <input type="file" class="form-control" name="foto">
                                <p>Tamaño máximo: 5MB.</p>
                              </div>
                        </div>

                        @if(Auth::user()->role=="Super usuario")
                        <div class="form-group">
                            <label for="inmobiliaria" class="col-md-4 control-label">Inmobiliaria</label>

                            <div class="col-md-6">
                                <select class="form-control" name="inmobiliaria">
                                <option selected="true" disabled="disabled">-Seleccione una inmobiliaria-</option>    
                                @foreach($inmobiliarias as $inmobiliaria)
                                    <option @if($user->inmobiliarias_id==$inmobiliaria->id) value="{{$inmobiliaria->id}}" selected=true @else value="{{$inmobiliaria->id}}" @endif >{{$inmobiliaria->nombre}}</option>
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
                                    <option @if($user->role==$role) selected="true" @endif>
                                    {{$role}}
                                    </option>
                                    @endforeach
                                @else
                                    <option @if($user->role==$roles[1]) selected="true" @endif>{{$roles[1]}}</option>
                                    <option @if($user->role==$roles[2]) selected="true" @endif>{{$roles[2]}}</option>
                                    <option @if($user->role==$roles[3]) selected="true" @endif>{{$roles[3]}}</option>
                                @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                        <label for="estatus" class="col-md-4 control-label">Estatus*</label>
                             <div class="col-md-6">
                                <select class="form-control" name="estatus">
                                <option value="Null" disabled>Seleccionar</option>
                                <option value="1" @if(($user->status=='1')||($user->status=='')) selected="true" @endif>Activo</option>
                                <option value="0" @if($user->status=='0') selected="true" @endif>Inactivo</option>
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
                                    Actualizar
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
