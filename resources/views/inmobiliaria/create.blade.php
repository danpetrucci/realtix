@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registro de inmobiliaria</div>
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
                    
                    
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/inmobiliaria') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="nombre" class="col-md-4 control-label">Nombre de la inmobiliaria*</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nit" class="col-md-4 control-label">NIT*</label>

                            <div class="col-md-6">
                            <input id="nit" type="text" class="form-control" name="nit" value="{{ old('nit') }}" autofocus maxlength="10">
                            </div>
                        </div>
                        
                        
                        <div id="ubicacion_inmo">
                <div class="form-group">
                        <label for="role" class="col-md-4 control-label">País*</label>
                            <div class="col-md-6">
                                <select class="form-control chosen-select" name="pais_inmo" id="pais_inmo" @change="getdepartamentos">
                                <option selected="true" disabled="disabled">
                                -Seleccione un Pais-
                                </option>  
                                <option v-for="pais in paises" v-bind:value="pais.id">
                                    @{{pais.nombre}}
                                </option>
                                </select>
                            </div>
                    </div>

                    <div class="form-group" v-show="colombia">
                    <label for="role" class="col-md-4 control-label">Departamento</label>
                            <div class="col-md-6">
                                <select class="form-control chosen-select" name="departamento_inmo" id="departamento_inmo" @change="getmunicipios">
                                <option selected="true" disabled="disabled">
                                -Seleccione un departamento-
                                </option> 
                                <option v-for="departamento in departamentos" v-bind:value="departamento.id">
                                    @{{departamento.descripcion}}
                                </option> 
                                
                                </select>
                            </div>
                    </div>


                    <div class="form-group" v-show="colombia">
                    <label for="role" class="col-md-4 control-label">Municipio/Ciudad</label>
                            <div class="col-md-6">
                                <select class="form-control chosen-select" name="ciudad_inmo" id="municipio_inmo">
                                <option selected="true" disabled="disabled">
                                -Seleccione un municipio-
                                </option> 
                                <option v-for="municipio in municipios" v-bind:value="municipio.id">
                                    @{{municipio.descripcion}}
                                </option> 
                                
                                </select>
                            </div>
                    </div>
                </div>  
                        
                        <div class="form-group">
                            <label for="dirección" class="col-md-4 control-label">Dirección</label>

                            <div class="col-md-6">
                                <input id="dirección" type="text" class="form-control" name="dirección" value="{{ old('dirección') }}" autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="teléfono" class="col-md-4 control-label">Teléfono</label>

                            <div class="col-md-6">
                                <input id="tel" type="text" class="form-control" name="teléfono" value="{{ old('teléfono') }}" autofocus maxlength="13">
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

<script src="/js/inmobiliaria_vue.js"></script>

@endsection
