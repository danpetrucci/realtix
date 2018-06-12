@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Creación de inmueble</div>
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
                           
                    
    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/inmueble') }}">
    {{ csrf_field() }}

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#propietario">Datos del propietario</a></li>
            <li><a data-toggle="tab" href="#geo">
            Ubicación</a></li>
            <li><a data-toggle="tab" href="#caracteristicas">
            Características</a></li>
             <li><a data-toggle="tab" href="#fotostab">
            Fotos & Documentos</a></li>
            <li><a data-toggle="tab" href="#adicionales">
            Adicionales & Guardar</a></li>
        </ul>

        <div class="tab-content">
            <div id="propietario" class="tab-pane fade in active">
                <br> 
                <div class="form-group">
                    <label for="nombre" class="col-md-4 control-label">Nombre*</label>
                        <div class="col-md-6">
                        <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" autofocus>
                        </div>
                </div>
                <div class="form-group">
                    <label for="apellido" class="col-md-4 control-label">Apellido*</label>
                        <div class="col-md-6">
                        <input type="text" class="form-control" name="apellido" value="{{ old('apellido') }}" autofocus>
                        </div>
                </div>

                <div class="form-group">
                        <label for="role" class="col-md-4 control-label">Tipo de documento*</label>
                            <div class="col-md-6">
                                <select class="form-control chosen-select" name="tipo_doc">
                                <option selected="true" disabled="disabled">
                                -Seleccione un tipo-
                                </option>  
                                <option value="cc">Cédula de ciudadanía</option>  
                                <option value="ce">Cédula de extranjería</option>
                                <option value="ni">Nit</option>
                                <option value="ps">Pasaporte</option>
                                </select>
                            </div>
                </div>


                <div class="form-group">
                    <label for="telefono" class="col-md-4 control-label">No. documento*</label>
                        <div class="col-md-6">
                        <input type="text" class="form-control" name="telefono" value="{{ old('telefono') }}" autofocus>
                        </div>
                </div>

                <div class="form-group">
                    <label for="telefono" class="col-md-4 control-label">Teléfono*</label>
                        <div class="col-md-6">
                        <input type="text" class="form-control" name="telefono" value="{{ old('telefono') }}" autofocus>
                        </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-md-4 control-label">Email*</label>
                        <div class="col-md-6">
                        <input type="Email" class="form-control" name="email" value="{{ old('email') }}" autofocus>
                        </div>
                </div>
                <div id="ubicacion_dueno">
                <div class="form-group">
                        <label for="role" class="col-md-4 control-label">País*</label>
                            <div class="col-md-6">
                                <select class="form-control chosen-select" name="pais_dueno" id="pais_dueno" @change="getdepartamentos">
                                <option selected="true" disabled="disabled">
                                -Seleccione un Pais-
                                </option>  
                                <option v-for="pais in paises" v-bind:value="pais.id">
                                    @{{pais.nombre}}
                                </option>
                                </select>
                            </div>
                    </div>

                    <div class="form-group"  v-show="colombia">
                    <label for="role" class="col-md-4 control-label">Departamento*</label>
                            <div class="col-md-6">
                                <select class="form-control chosen-select" name="departamento_dueno" id="departamento_dueno" @change="getmunicipios">
                                <option selected="true" disabled="disabled">
                                -Seleccione un departamento-
                                </option> 
                                <option v-for="departamento in departamentos" v-bind:value="departamento.id">
                                    @{{departamento.descripcion}}
                                </option> 
                                
                                </select>
                            </div>
                    </div>


                    <div class="form-group"  v-show="colombia">
                    <label for="role" class="col-md-4 control-label">Municipio/Ciudad*</label>
                            <div class="col-md-6">
                                <select class="form-control chosen-select" name="ciudad_dueno" id="municipio_dueno">
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
                    <label for="direccion" class="col-md-4 control-label">Dirección*</label>
                        <div class="col-md-6">
                        <input type="text" class="form-control" name="direccion" value="{{ old('direccion') }}" autofocus>
                        </div>
                </div>

                <div class="form-group">
                <label class="col-md-4 control-label">Observación</label>
                        <div class="col-md-6">
                        <textarea class="form-control col-md-4"  rows="4" name="observacion_dueno"></textarea>
                        </div>
                </div>


                <br>
                
            </div>
            
            <!-- Ubicacion geografica -->              
                <div id="geo" class="tab-pane fade">
                    <br>
                    
                    <div id="ubicacion">
                
                    <div class="form-group">
                        <label for="role" class="col-md-4 control-label">País*</label>
                            <div class="col-md-6">
                                <select class="form-control chosen-select" name="pais" id="pais" @change="getdepartamentos">
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
                    <label for="role" class="col-md-4 control-label">Departamento*</label>
                            <div class="col-md-6">
                                <select class="form-control chosen-select" name="departamento" id="departamento" @change="getmunicipios">
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
                    <label for="role" class="col-md-4 control-label">Municipio/Ciudad*</label>
                            <div class="col-md-6">
                                <select class="form-control chosen-select" name="municipio" id="municipio" @change="askbogota">
                                <option selected="true" disabled="disabled">
                                -Seleccione un municipio-
                                </option> 
                                <option v-for="municipio in municipios" v-bind:value="municipio.id">
                                    @{{municipio.descripcion}}
                                </option> 
                                
                                </select>
                            </div>
                    </div>

                    
                    <div class="form-group">
                        <label for="comuna" class="col-md-4 control-label" >
                        <div v-if="comunas">Comuna</div>
                        <div v-if="localidads">Localidad</div>
                        </label>
        
                        <div class="col-md-6">
                        <input type="text" class="form-control" name="comuna" value="{{ old('comuna') }}" autofocus>
                        </div>
                    </div>
                    </div>
                     <div class="form-group">
                        <label for="barrio" class="col-md-4 control-label">Barrio*</label>
                        <div class="col-md-6">
                        <input type="text" class="form-control" name="barrio" value="{{ old('barrio') }}" autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                    <label for="direccion" class="col-md-4 control-label">Dirección*</label>
                        <div class="col-md-6">
                        <input type="text" class="form-control" name="direccion" value="{{ old('direccion') }}" autofocus>
                        </div>
                    </div>
                    <br>
                </div>

                <!-- Caracteristicas del inmueble -->

                <div id="caracteristicas" class="tab-pane fade">
                    <br>
                <div class="col-md-6">

                    <div class="form-group">
                    <label for="publicacion" class="col-md-4 control-label">Título de la publicación*</label>
                        <div class="col-md-6">
                        <input type="text" class="form-control" name="publicacion" value="{{ old('publicacion') }}" placeholder="Ej: Lujoso apartamento en zona residencial.." autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="role" class="col-md-4 control-label">Tipo de Negocio*</label>
                            <div class="col-md-6">
                                <select class="form-control chosen-select" name="negocio" id="negocio" @change="arriendocheck">
                                <option selected="true" disabled="disabled">
                                -Seleccione un tipo-
                                </option>  
                                <option value="arriendo">Arriendo</option>  
                                <option value="venta">Venta</option>
                                <option value="permuta">Permuta</option>  
                                <option value="cesion">Cesión de derechos</option>
                                </select>
                            </div>
                    </div>

                    <div class="form-group">
                        <label for="role" class="col-md-4 control-label">Estado de la propiedad*</label>
                            <div class="col-md-6">
                                <select class="form-control chosen-select" name="estado">
                                <option selected="true" disabled="disabled">
                                -Seleccione un estado-
                                </option>  
                                <option value="nuevo">Nuevo</option>  
                                <option value="usado">Usado</option>
                                </select>
                            </div>
                    </div>

                    
                        <div class="form-group">
                        <label for="role" class="col-md-4 control-label">Categoría*</label>
                            <div class="col-md-6">
                                <select class="form-control chosen-select" name="categoria" id="categoria" @change="validarcategoria">
                                <option selected="true" disabled="disabled">
                                -Seleccione un tipo-
                                </option>  
                                <option value="vivienda">Vivienda</option>  
                                <option value="comercial">Comercial/Industrial</option>
                                <option value="turismo">Turismo y descanso</option>  
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                        <label for="role" class="col-md-4 control-label">Tipo de propiedad*</label>
                            <div class="col-md-6">
                                <select class="form-control chosen-select" name="tipo_propiedad_detalle" id="tipo_propiedad_detalle" @change="validartipopropiedad">
                                <option selected="true" disabled="disabled">
                                -Seleccione un tipo-
                                </option> 
                                <option v-for="option in opciones_tipo_propiedad" v-bind:value="option.value">
                                @{{ option.text }}
                                </option> 
                                  
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                        <label for="estrato" class="col-md-4 control-label">Estrato*</label>
                        <div class="col-md-6">
                                <select class="form-control chosen-select" name="estrato">
                                <option selected="true" disabled="disabled">
                                -Seleccione un estrato-
                                </option>  
                                <option value="1">1</option>  
                                <option value="2">2</option>
                                <option value="3">3</option>  
                                <option value="4">4</option>
                                <option value="5">5</option>  
                                <option value="6">6</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" v-if="v_uso_lote">
                        <label for="uso_lote" class="col-md-4 control-label">Uso del Lote*</label>
                        <div class="col-md-6">
                                <select class="form-control chosen-select" name="uso_lote">
                                <option selected="true" disabled="disabled">
                                -Seleccione-
                                </option> 
                                <option value="residencial">Residencial</option>  
                                <option value="comercial">Comercial</option>
                                 <option value="industrial">Industrial</option>
                                  <option value="especiales">Usos especiales (Servicios, Salud, Educación, Agrícola)</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" v-if="v_amoblado">
                        <label for="edad" class="col-md-4 control-label">Edad del inmueble*</label>
                        <div class="col-md-6">
                                <select class="form-control chosen-select" name="edad">
                                <option selected="true" disabled="disabled">
                                -Seleccione-
                                </option>  
                                <option value="-5">Entre 0 y 5 años</option>  
                                <option value="5/10">Entre 5 y 10 años</option>
                                 <option value="10/15">Entre 10 y 15 años</option>
                                  <option value="+15">Más de 15 años</option>
                                </select>
                            </div>
                        </div>

                        
                        <div class="form-group" v-if="v_piso">
                        <label for="piso" class="col-md-4 control-label">Ubicado en el piso*</label>
                            <div class="col-md-6">
                            <input type="number" min="1" max="99" class="form-control" name="piso" value="{{ old('piso') }}" autofocus>
                            </div>
                        </div>

                        <div class="form-group" v-if="v_niveles">
                        <label for="niveles" class="col-md-4 control-label">Niveles</label>
                            <div class="col-md-6">
                            <input type="number" min="1" max="5" class="form-control" name="niveles" value="{{ old('niveles') }}" autofocus>
                            </div>
                        </div>

                    <div class="form-group" v-if="v_amoblado">
                        <label for="estrato" class="col-md-4 control-label">¿Amoblado?</label>
                        <div class="col-md-6">
                                <select class="form-control chosen-select" name="amoblado">
                                <option selected="true" disabled="disabled">
                                -Seleccione-
                                </option>  
                                <option value="true">Si</option>  
                                <option value="false">No</option>
                                </select>
                            </div>
                        </div>


                    <div class="form-group" v-if="v_habitaciones">
                    <label for="habitaciones" class="col-md-4 control-label">N° Habitaciones*</label>
                            <div class="col-md-6">
                            <input type="number" min="0" class="form-control" name="habitaciones" value="{{ old('habitaciones') }}" autofocus>
                            </div>
                    </div>

                    <div class="form-group" v-if="v_banos">
                    <label for="banos" class="col-md-4 control-label">N° Baños*</label>
                            <div class="col-md-6">
                            <input type="number" min="0" class="form-control" name="banos" value="{{ old('banos') }}" autofocus>
                            </div>
                    </div>


                    <div class="form-group" v-if="v_estudios">
                    <label for="estudios" class="col-md-4 control-label">N° Estudios</label>
                            <div class="col-md-6">
                            <input type="number" min="0" class="form-control" name="estudios" value="{{ old('estudios') }}" autofocus>
                            </div>
                    </div>

                      <div class="form-group" v-if="v_garajes">
                    <label for="garajes" class="col-md-4 control-label">N° Parquederos*</label>
                            <div class="col-md-6">
                            <input type="number" min="0" class="form-control" name="garajes" value="{{ old('garajes') }}" autofocus>
                            </div>
                    </div>

                     <div class="form-group" v-if="v_pisos">
                    <label for="pisos" class="col-md-4 control-label">N° Pisos*</label>
                            <div class="col-md-6">
                            <input type="number" min="0" class="form-control" name="pisos" value="{{ old('pisos') }}" autofocus>
                            </div>
                    </div>


                    <div class="form-group" v-if="v_depositos">
                    <label for="depositos" class="col-md-4 control-label">N° Depósitos*</label>
                            <div class="col-md-6">
                            <input type="number" min="0" class="form-control" name="depositos" value="{{ old('depositos') }}" autofocus>
                            </div>
                    </div>

                        <br>
                        <div class="form-group">
                              <label class="col-md-4 control-label"></label>
                            <div class="col-md-6">
                            <p>*Campos obligatorios.</p>
                            </div>
                              
                        </div>
                        <br>
                </div>

                <!--Columnna Dos -->
                <div class="col-md-6">

                    <div class="form-group" v-if="v_internas">
                        <div class="col-md-10">
                        <label class="typo__label">Características internas</label>
                         <div class="dropdown">
                            <multiselect v-model="value_internas" :options="internas" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" placeholder="Seleccione" label="name" track-by="name" name="externas"></multiselect>
                        </div>
                        </div>
                    </div>
                    
                    <div class="form-group" v-if="v_terreno">
                    <label for="area_terreno" class="col-md-4 control-label">Area del Terreno</label>
                            <div class="col-md-3">
                            <input type="number" min="1" class="form-control" name="area_terreno" value="{{ old('area_terreno') }}" autofocus>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control chosen-select" name="area_terreno_unidad">
                                <option selected="true" disabled="disabled">
                                -Unidad-
                                </option>  
                                <option value="metros">Metros Cuadrados</option>  
                                <option value="hectareas">Hectáreas</option>
                                <option value="fanegadas">Fanegadas</option>  
                                </select>
                            </div>
                    </div>

                <div v-if="v_propiedad_horizontal">
                    <div class="form-group">                    
                      <label class="col-md-6">
                        ¿Tiene propiedad horizontal?
                        <div class="switch">
                            <input id="cmn-toggle-4" class="cmn-toggle cmn-toggle-round" type="checkbox" v-model="horizontal" name="horizontal">
                            <label for="cmn-toggle-4"></label>
                        </div>
                        </label>
                    </div> 

                        <div class="form-group" v-if="horizontal">
                        <div class="col-md-10">
                        <label class="typo__label">Características externas</label>
                         <div class="dropdown">
                            <multiselect v-model="value_externas" :options="externas" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" placeholder="Seleccione" label="name" track-by="name" name="externas"></multiselect>
                        </div>
                        </div>
                        </div>
                </div>
                    
                    <div class="form-group" v-if="v_construida">
                    <label for="area_construida" class="col-md-4 control-label">Area Construida*(m²)</label>
                            <div class="col-md-6">
                            <input type="number" min="1" class="form-control" name="area_construida" value="{{ old('area_construida') }}" autofocus>
                            </div>
                    </div>

                    <div class="form-group" v-if="v_privada">
                    <label for="area_privada" class="col-md-4 control-label">Area Privada(m²)</label>
                            <div class="col-md-6">
                            <input type="number" min="1" class="form-control" name="area_privada" value="{{ old('area_privada') }}" autofocus>
                            </div>
                    </div>

                    <div class="form-group">
                        <label for="moneda" class="col-md-4 control-label">Tipo de moneda*</label>
                        <div class="col-md-6">
                                <select class="form-control chosen-select" name="moneda">
                                <option selected="true" disabled="disabled">
                                -Seleccione un tipo-
                                </option>  
                                <option value="peso">Peso</option>  
                                <option value="dolar">Dólar</option>
                                <option value="euro">Euro</option>  
                                </select>
                            </div>
                        </div>

                   

                    <div class="form-group">
                    <label for="precio" class="col-md-4 control-label">@{{label_precio}}</label>
                            <div class="col-md-6">
                            <input type="text" class="form-control" name="precio" value="{{ old('precio') }}" autofocus>
                            </div>
                    </div>

                     <div class="form-group">
                    <label for="administracion" class="col-md-4 control-label">Valor Administración</label>
                            <div class="col-md-6">
                            <input type="text" class="form-control" name="administracion" value="{{ old('administracion') }}" autofocus>
                            </div>
                    </div>

                   <div v-if="v_entrega"> 

                    <div class="form-group" >
                    <label for="entrega" class="col-md-4 control-label">Fecha tentativa de entrega</label>
                            <div class="col-md-6">
                            <input type="date" class="form-control" name="entrega" value="{{ old('entrega') }}" autofocus>
                            </div>
                    </div>

                    <div class="form-group">
                        <label for="contrato" class="col-md-4 control-label">Tipo de contrato</label>
                        <div class="col-md-6">
                                <select class="form-control chosen-select" name="contrato">
                                <option selected="true" disabled="disabled">
                                -Seleccione un tipo-
                                </option>  
                                
                            <option value="fiduciario">Encargo fiduciario</option>  
                            <option value="constructora">Directo con constructora</option>  
                                </select>
                            </div>
                        </div>


                    </div>


                    <div class="form-group">
                    <label for="comision" class="col-md-4 control-label">Comisión Pactada(%)*</label>
                            <div class="col-md-6">
                            <input type="number" min="1" class="form-control" name="comision" value="{{ old('comision') }}" autofocus>
                            </div>
                    </div>




                </div>

                </div>

                <!--Adjuntar Fotos y documentos-->

                <div id="fotostab" class="tab-pane fade">
                <br>

                    <div class="form-group">
                    <label for="youtube" class="col-md-4 control-label">Link de video</label>
                            <div class="col-md-6">
                            <input type="text" min="1" class="form-control" name="youtube" placeholder="https://" value="{{ old('youtube') }}" autofocus>
                            </div>
                    </div>

                    <div class="form-group">
                    <label for="fotos" class="col-md-4 control-label">Adjuntar fotos*</label>
                            <div class="col-md-6">
                            <input type="file" name="fotos"  multiple="multiple">
                            <p class="help-block">
                            Elija multiples fotos. Archivos en formato .jpg </p>
                            </div>
                    </div>

                    <div class="form-group">
                    <label for="documentos" class="col-md-4 control-label">Adjuntar documentos legales*</label>
                        <div class="col-md-6">
                        <input type="file" name="documentos" multiple="multiple">
                        <p class="help-block">Elija multiples documentos. Archivos en formato .doc o .pdf</p>
                            </div>
                    </div>
                </div>

                <!--Adicionales y guardar -->

                <div id="adicionales" class="tab-pane fade">
                    <br>
                  <div class="col-md-6">  
                    
                    <div class="form-group">                    
                      <label class="col-md-6 col-md-offset-4">
                        ¿Comisión compartida?
                        <div class="switch">
                            <input id="cmn-toggle-1" class="cmn-toggle cmn-toggle-round" type="checkbox" name="compartida" v-model="compartida">
                            <label for="cmn-toggle-1"></label>
                        </div>
                        </label>
                    </div>

                    <div class="form-group" v-if="compartida">
                    <label for="comision" class="col-md-4 control-label">Porcentaje</label>
                            <div class="col-md-6">
                            <input type="number" min="1" class="form-control" name="porcentaje" value="{{ old('porcentaje') }}" autofocus>
                            </div>
                    </div>

                   

                     

                </div>

                <div class="col-md-6">

                    <div class="form-group">                    
                      <label class="col-md-12 col-md-offset-1">
                        ¿Compartir en nuestra red de inmobiliarias?
                        <div class="switch">
                            <input id="cmn-toggle-2" class="cmn-toggle cmn-toggle-round" type="checkbox" name="compartir_red">
                            <label for="cmn-toggle-2"></label>
                        </div>
                        </label>
                    </div> 

                    <div class="form-group">                    
                      <label class="col-md-6 col-md-offset-1">
                        ¿Publicar en otros portales?
                        <div class="switch">
                            <input id="cmn-toggle-3" class="cmn-toggle cmn-toggle-round" type="checkbox" name="publicar">
                            <label for="cmn-toggle-3"></label>
                        </div>
                        </label>
                    </div>

                     </div>

                     <div class="col-md-8 col-md-offset-2">

                        <label>Nota</label>
                        <textarea class="form-control" rows="4" name="nota"></textarea>
                    <br>
                        <div class="form-group">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    Guardar
                                </button>
                            </div>
                        </div>
                         </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/inmueble_vue.js"></script>
@endsection

