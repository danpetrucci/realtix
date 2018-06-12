<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Inmobiliarias;
use Redirect;
use Session;
use App\User;
use App\Paises;
use App\Departamentos;
use App\Municipios;


use App\Http\Requests;

class InmobiliariasController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todas_inmobiliarias = Inmobiliarias::paginate(15);
        $total_inmobiliarias = Inmobiliarias::count();
        return view('inmobiliaria/index')
                ->with('todas_inmobiliarias',$todas_inmobiliarias)
                ->with('total_inmobiliarias',$total_inmobiliarias);
    }

    public function search()
    {  
        $keyword = Input::get('keyword', '');
        $todas_inmobiliarias = Inmobiliarias::SearchByKeyword($keyword)->paginate(15);
        $total_inmobiliarias = Inmobiliarias::count();
        
        return view('inmobiliaria/index')
                ->with('todas_inmobiliarias',$todas_inmobiliarias)
                ->with('total_inmobiliarias',$total_inmobiliarias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inmobiliaria/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|max:255|unique:inmobiliarias,nombre',
            'nit'=> 'required|alpha_num|max:10|unique:inmobiliarias,nit',
            'pais_inmo' => 'required',
            'teléfono' => 'numeric|digits_between:7,13'
        ]);

        $pais_id=$request['pais_inmo'];
        $pais=Paises::where('id',$pais_id)
        ->pluck('nombre');

        $departamento_id=$request['departamento_inmo'];
        $departamento=Departamentos::where('id',$departamento_id)
        ->pluck('descripcion');

        $ciudad_id=$request['ciudad_inmo'];
        $ciudad=Municipios::where('id',$ciudad_id)->pluck('descripcion');
        
        Inmobiliarias::create([
            'nombre' => $request['nombre'],
            'nit'=>$request['nit'],
            'pais_inmo'=>$pais[0],
            'departamento_inmo'=>$departamento[0],
            'ciudad_inmo' => $ciudad[0],
            'direccion' => $request['dirección'],
            'telefono' => $request['teléfono']
        ]);
        
        Session::flash('message', 'Inmobiliaria creada exitosamente!');
        
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inmo = Inmobiliarias::find($id);
        
        return view('inmobiliaria/edit')
            ->with('inmo',$inmo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $this->validate($request, [
            'nombre' => 'required|max:255',
            'teléfono' => 'numeric|digits_between:7,13',
            'pais'=>'required',
            'nit'=> 'required|alpha_num|max:10',
        ]);

        $pais_id=$request['pais'];
        $pais=Paises::where('id',$pais_id)
        ->pluck('nombre');

        if($request['departamento']!=""){
            $departamento_id=$request['departamento'];
            $departamento=Departamentos::where('id',$departamento_id)
            ->pluck('descripcion');
        }else{
            $departamento=Null;
        }
        
        if($request['ciudad']!=""){
            $ciudad_id=$request['ciudad'];
            $ciudad=Municipios::where('id',$ciudad_id)->pluck('descripcion');
        }else{
            $ciudad=Null;
        }

        $inmo = Inmobiliarias::find($id);
        $inmo->nombre=$request['nombre'];
        $inmo->nit=$request['nit'];
        $inmo->pais_inmo=$pais[0];
        $inmo->departamento_inmo=$departamento[0];
        $inmo->ciudad_inmo=$ciudad[0];
        $inmo->direccion=$request['dirección'];
        $inmo->telefono=$request['teléfono'];
        $inmo->save();

        Session::flash('message', 'Inmobiliaria actualizada exitosamente!');
        
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $usercount=User::where('inmobiliarias_id',$id)->count();

        if($usercount>0){
        // redirect
        Session::flash('error', 'No es posible! Existen aún usuarios  asignados a esta inmobiliaria.');
        return Redirect::back();
        }else
        {
        // delete
        $inmo = Inmobiliarias::find($id);
        $inmo->delete();

        // redirect
        Session::flash('message', 'Inmobiliaria borrada exitosamente!');
        return Redirect::back();
        }
    }
}
