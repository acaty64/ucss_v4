<?php

namespace App\Http\Controllers\Admin;

use App\Acceso;
use App\DHora;
use App\DataUser;
use App\Facultad;
use App\Http\Controllers\Controller;
use App\Sede;
use App\Type;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $facultad_id = Session::get('facultad_id');
        $sede_id = Session::get('sede_id');
        $acceso_auth = Acceso::acceso_auth();

        $accesos = Acceso::where('facultad_id',$facultad_id)->where('sede_id',$sede_id)->search($request->get('wdocente'), $request->get('type'))->paginate(6);

        $title = Facultad::find($facultad_id)->wfacultad .' - '.Sede::find($sede_id)->wsede ;
        $types = Type::where('name','!=','Master')->get();
        $xtypes = [];
        foreach ($types as $type) {
            $xtypes[$type->id] = $type->name;
        }
        return view('admin.user.index')
                ->with('title',$title)
                ->with('users',$accesos)
                ->with('types',$xtypes)
                ->with('acceso_auth',$acceso_auth)
                ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cdocente = DataUser::find(1)->newcodigo();

        // Recibe los datos del formulario de resources\admin\users\create.blade.php
        $facultad_id = Session::get('facultad_id');
        $sede_id = Session::get('sede_id');

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save(); 
        
        // Crea un registro en DataUser
        $datauser = new DataUser();
        $datauser->user()->associate($user);
        $datauser->cdocente = $cdocente;
        $datauser->wdoc1 = $user->name;
        $datauser->email1 = $user->email;
        $datauser->save();
        
        // Crea un registro en Accesos
        $acceso = new Acceso();
        $acceso->user()->associate($user);           
        $acceso->facultad_id = $facultad_id;
        $acceso->sede_id = $sede_id;
        /// $acceso->type_id = 2; Default = 2 ** Consulta   
        $acceso->swcierre = false;
        $acceso->save();

        Flash::success('Se ha registrado '.$user->name.' de forma exitosa');
        return redirect()->route('administrador.user.index');

    }
  

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('errors.000');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id); 
        return view('admin.user.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        Flash::warning('Se ha modificado el registro: '.$user->id.' : '.$user->name.' de forma exitosa');
        return redirect()->route('administrador.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();          
        Flash::error('Se ha eliminado el registro: '.$user->id.' '.$user->name.' de forma exitosa');
        return redirect()->route('administrador.user.index');
    }

    /**********************************************/
    /* Edita el password
    /**********************************************/
    public function editpass($id)
    {
        $user = User::find($id);
        return view('admin.users.chpass')->with('user', $user);
    }

    /**********************************************/
    /* Graba el password 
    /**********************************************/
    public function savepass(Request $request, $id)
    {
//        dd($id);
        if ($request->password == $request->checkpassword) 
        {
            $user = User::find($id);
            $user->password = bcrypt($request->password);
            $user->save(); 
            Flash::success('Se ha modificado el password de '.$user->wdocente($id).' de forma exitosa');
            return redirect()->route('admin.user.index');
        }else{
            Flash::success('Ingrese la misma clave en las dos casillas.');
            return redirect()->back();
        }
    }

    /**********************************************/
    /* Encripta los passwords
    /**********************************************/
    public function cryptpass($id)
    {
        // dd('cryptpass');
        $contador = 0;
        $users = User::all(); 
        foreach ($users as $user) 
        {
//            dd($user);
            $password = $user->password;
//            dd('lenght'.strlen($password));
            if (strlen(trim($password)) < 15) {
                $xuser = User::find($user->id);
                $user->password = bcrypt($password);
                $user->save();
                $contador++;
            }    
        }
        Flash::success($contador.' Passwords encriptados.');
            return redirect()->back();

    }

}