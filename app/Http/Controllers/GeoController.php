<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Paises;
use App\Departamentos;
use App\Municipios;

class GeoController extends Controller
{
	public function paises(){
		$paises=Paises::get();
	
	return $paises;	
	}

	public function departamentos($id){
		$departamentos=Departamentos::where('pais_id',$id)->get();
	
	return $departamentos;
	}  

	public function municipios($id){
		$municipios=Municipios::where('departamento_id',$id)->get();
	
	return $municipios;
	}    
}
