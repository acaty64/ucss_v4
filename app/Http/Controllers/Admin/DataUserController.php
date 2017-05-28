<?php

namespace App\Http\Controllers\Admin;

use App\Acceso;
use App\DataUser;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class DataUserController extends Controller
{

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
    public function edit($user_id)
    {
        $datauser = User::find($user_id)->datauser; 
        //DataUser::where('user_id',$user_id)->first();
        return view('admin.datauser.edit')
            ->with('datauser', $datauser);
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
        $datauser = DataUser::find($request->id);
        $datauser->fill($request->all());
        $datauser->save();

        $acceso = Acceso::where('user_id',$request->user_id)->first();
        $acceso->wdocente = $user->wdoc2 . " " .$user->wdoc3. ", ".$user->wdoc1;  
        $acceso->save();


        Flash::warning('Se ha modificado el registro: '.$datauser->id.' código : '.$datauser->cdocente.' de forma exitosa');
        return redirect()->route('admin.user.index');
    }

}
