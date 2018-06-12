<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inmuebles extends Model
{
    protected fillable=[
    					'codigo',
     					'status',
            			'inmobiliarias_id',
            			'user_id',        
            			'asesor',
						'nombre_dueno',
            			'apellido_dueno',
            			'tipo_doc',
            			'doc',
            			'telefono_dueno',
            			'email_dueno',
            			'pais_dueno',
            			'departamento_dueno',
            			'ciudad_dueno',
            			'domicilio_dueno',
            			'apoderado',
            			'observacion_dueno',
            			'pais_id',
			            'departamento_id',
			            'municipio_id',
			            'orientacion',
			            'comuna',
			            'barrio',
			            'direccion',
			            'latitud',
			            'longitud',
					    'publicacion',
					    'tipo_negocio',
					    'estado_fisico',
					    'tipo_propiedad',
					    'tipo_propiedad_detalle',
					    'estrato',
					    'edad',
					    'piso_ubicacion',
					    'niveles',
					    'habitaciones',
					    'banos',
					    'garajes',
					    'depositos',
					    'estudios',
					    'area_terreno',
					    'area_terreno_unidad',
					    'area_construida',
					    'area_privada',
					    'tipo_moneda',
					  	'valor_metro', 
					    'valor', 
					    'precio',
					    'administracion', 
					    'comision',
					    'youtubelink',
					    'imagenes',
					    'documentos',
					    'comision_compartida',   
					    'porcentaje',         
					    'publicar_otras',
					    'comparte_red',
					    'propiedad_horizontal',
					    'caracteristicas_externas',
					    'caracteristicas_internas',
					    'nota'
					    ];

	public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }				    

    public function inmobiliaria()
    {
        return $this->hasOne('App\Inmobiliarias','id','inmobiliarias_id');
    }

	public function pais()
    {
        return $this->hasOne('App\Paises','id','pais_id');
    }

	public function departamento()
    {
        return $this->hasOne('App\Departamentos','id','departamento_id');
    }	

    public function municipio()
    {
        return $this->hasOne('App\Municipios','id','municipio_id');
    }			    

}
