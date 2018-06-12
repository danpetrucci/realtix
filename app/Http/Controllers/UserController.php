<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

use Session;
use Redirect;
use App\User;
use App\Inmobiliarias;
use Auth;
use File;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        
        if (Auth::user()->role=="Super usuario"){
            $users = User::with('inmobiliaria')->paginate(15);        
            $totalusers = User::count();
        }else{
            $users = User::with('inmobiliaria')
                ->where('inmobiliarias_id',Auth::user()->inmobiliarias_id)
                ->paginate(15);
            $totalusers = User::where('inmobiliarias_id',Auth::user()->inmobiliarias_id)->count();
        }
        $countsearch="";

        return view('/auth/userlist')
                ->with('users',$users)
                ->with('totalusers',$totalusers)
                ->with('countsearch',$countsearch);
    }

    public function search(){
       
        $keyword = Input::get('keyword', '');
        $totalusers="";

        if (Auth::user()->role=="Super usuario"){
            $users = User::with('inmobiliaria')->SearchByKeyword($keyword)->paginate(15);
            
            $countsearch = User::with('inmobiliaria')->SearchByKeyword($keyword)->count();
        }else{
            $users = User::with('inmobiliaria')
                    ->where('inmobiliarias_id',Auth::user()->inmobiliarias_id)
                    ->SearchByKeyword($keyword)->paginate(15);

            $countsearch = User::with('inmobiliaria')
                    ->where('inmobiliarias_id',Auth::user()->inmobiliarias_id)
                    ->SearchByKeyword($keyword)->count();
        }
        
        return view('/auth/userlist')
                ->with('users',$users)
                ->with('totalusers',$totalusers)
                ->with('countsearch',$countsearch);
    }

    public function show($id){

        $user=User::where('id',$id)->first();
        
        $roles = ['Super usuario','Administrativo','Aprobador','Agente'];
 
        $ciudades = ['Bogotá','Medellín','Cali','Barranquilla','Cartagena de Indias',
                    'Cúcuta','Soledad','Ibagué','Bucaramanga','Soacha','Santa Marta',
                    'Villavicencio','Bello','Pereira','Valledupar','Buenaventura','Pasto',
                    'Manizales','Montería','Neiva'];

        $inmobiliarias = Inmobiliarias::select('id','nombre')->get();

        return view('/auth/useredit')
                ->with('user',$user)
                ->with('inmobiliarias',$inmobiliarias)
                ->with('roles',$roles)
                ->with('ciudades',$ciudades);
    }

    public function update(Request $request){


        if (Auth::user()->role=="Super usuario"){
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'rol'=>'required',
            'ciudad' => 'required',
            'teléfono' => 'numeric|digits_between:7,13',
            'foto' => 'mimes:jpg,jpeg,png,bmp|max:5024',
            'inmobiliaria' => 'required',
            'estatus' => 'required'
        ]);
        }else{
            $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'rol'=>'required',
            'ciudad' => 'required',
            'foto' => 'mimes:jpg,jpeg,png,bmp|max:5024',
            'teléfono' => 'required|numeric|digits_between:7,13',
             'estatus' => 'required'
        ]);
        }

        if (Auth::user()->role=="Super usuario"){
            $inmo=$request['inmobiliaria'];
        }else{
            $inmo=Auth::user()->inmobiliarias_id;
        }

        $user = User::find($request['userid']);

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->role = $request['rol'];
        $user->ciudad = $request['ciudad'];
        $user->telefono = $request['teléfono'];
        $user->inmobiliarias_id = $inmo;
        $user->status = $request['estatus'];
        $user->save();

        if ($request->hasFile('foto')) {
            //$extension = $request->foto->extension();
            $extension = "jpeg";
            $salvarfoto = $request->file('foto')->storeAs('public/avatars', $request['userid'].".".$extension);    
        }

         Session::flash('message', 'Usuario actualizado exitosamente!');

         return Redirect::back();
    }

    
    public function create(){

        $roles = ['Super usuario','Administrativo','Aprobador','Agente'];
 
        $ciudades = ['Bogotá','Medellín','Cali','Barranquilla','Cartagena de Indias',
                    'Cúcuta','Soledad','Ibagué','Bucaramanga','Soacha','Santa Marta',
                    'Villavicencio','Bello','Pereira','Valledupar','Buenaventura','Pasto',
                    'Manizales','Montería','Neiva'];

        $inmobiliarias = Inmobiliarias::select('id','nombre')->get();
       
        return view('auth/registeruser')
                ->with('inmobiliarias',$inmobiliarias)
                ->with('roles',$roles)
                ->with('ciudades',$ciudades);
    }
    
    protected function store(Request $request)
    {
        if (Auth::user()->role=="Super usuario"){
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'rol'=>'required',
            'ciudad' => 'required',
            'teléfono' => 'required|numeric|digits_between:7,13',
            'foto' => 'mimes:jpg,jpeg,png,bmp|max:5024',
            'inmobiliaria' => 'required'
        ]);
        }else{
            $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'rol'=>'required',
            'ciudad' => 'required',
            'foto' => 'mimes:jpg,jpeg,png,bmp|max:5024',
            'teléfono' => 'required|numeric|digits_between:7,13',
        ]);
        }

        if (Auth::user()->role=="Super usuario"){
            $inmo=$request['inmobiliaria'];
        }else{
            $inmo=Auth::user()->inmobiliarias_id;
        }

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'role' => $request['rol'],
            'ciudad' => $request['ciudad'],
            'telefono' => $request['teléfono'],
            'inmobiliarias_id' => $inmo
        ]);

        if ($request->hasFile('foto')) {
            $usercreated = User::where('email',$request['email'])->pluck('id');
            $extension = $request->foto->extension();
            $salvarfoto = $request->file('foto')->storeAs('public/avatars', $usercreated[0].".".$extension);    
        }
        
        Session::flash('message', 'Usuario creado exitosamente!');
        
        return Redirect::back();
    }

    public function destroy($id){
        if(Auth::user()->id==$id){
            Session::flash('error', 'No puede borrarse a usted mismo.');
            return Redirect::back();
        }
        else
        {
            // delete
            $user = User::find($id);
            $user->delete();

            // redirect
            Session::flash('message', 'Usuario borrado exitosamente!');
            return Redirect::back();
        }
    }

}
