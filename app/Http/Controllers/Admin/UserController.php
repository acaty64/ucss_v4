<?php

namespace App\Http\Controllers\Admin;

use App\Acceso;
use App\DHora;
use App\DataUser;
use App\Facultad;
use App\Franja;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Sede;
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
//        $hoy = Carbon::now();

        $facultad_id = Session::get('facultad_id');
        $sede_id = Session::get('sede_id');
        $accesos = Acceso::where('facultad_id',$facultad_id)->where('sede_id',$sede_id)->get();
        $title = Facultad::find($facultad_id)->wfacultad .' - '.Sede::find($sede_id)->wsede ;

        return view('admin.user.preindex')
                ->with('title',$title)
                ->with('users',$accesos);
//            ->with('hoy',$hoy);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$user = new User;
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
        // Verifica que no exista el cdocente
        $check = DataUser::where('cdocente','=',$request->cdocente)->first();

        if(empty($check))
        {
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
            $datauser->cdocente = $request->cdocente;
            $datauser->wdoc1 = $user->name;
            $datauser->email1 = $user->email;
            $datauser->slug = $datauser->wdocente();
            $datauser->save();
            
            // Crea un registro en Accesos
            $acceso = new Acceso();
            $acceso->user()->associate($user);           
            $acceso->facultad_id = $facultad_id;
            $acceso->sede_id = $sede_id;
            $acceso->type_id = $request->type_id;
            $acceso->swcierre = false;
            $acceso->save();

            // Crea un registro en DHora
            $dhora = new DHora();
            $dhora->user()->associate($user);
            $dhora->facultad_id = $facultad_id;
            $dhora->sede_id = $sede_id;
            $dhora->save();

            Flash::success('Se ha registrado '.$user->name.' de forma exitosa');
            return redirect()->route('admin.user.index');
        }else{
            Flash::error('ERROR, Ya existe el usuario con código: '.$request->cdocente);
            return redirect()->back();
        }
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
        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        $user->save();

        Flash::warning('Se ha modificado el registro: '.$user->id.' : '.$user->name.' de forma exitosa');
        return redirect()->route('admin.user.index');

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
        return redirect()->route('admin.user.index');
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