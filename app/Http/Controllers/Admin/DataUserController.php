<?php 

namespace App\Http\Controllers\Admin;

use App\Acceso;
use App\DataUser;
use App\Http\Controllers\Controller;
use App\User;
use Barryvdh\DomPDF\loadHTML;
use Barryvdh\DomPDF\stream;
use Illuminate\Foundation\Auth\Access\can;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;

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
        $acceso_auth = Acceso::acceso_auth();

        $user = User::find($id);
        $datauser = $user->datauser;

        $facultad_id = Session::get('facultad_id');
        $sede_id = Session::get('sede_id');
        $acceso = Acceso::where('facultad_id',$facultad_id)->where('sede_id',$sede_id)->where('user_id', $id)->first();

        return view('consulta.user')
            ->with('user', $user)
            ->with('datauser', $datauser)
            ->with('acceso', $acceso);

/**        $view = \View::make('pdf.usuario', compact('user','datauser','acceso'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('usuario');
*/
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
        $acceso_auth = Acceso::acceso_auth();
        return view('admin.datauser.edit')
            ->with('datauser', $datauser)
            ->with('acceso_auth',$acceso_auth);
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
        // Actualiza el valor de wdocente de la tabla acceso
        $acceso = Acceso::where('user_id',$request->user_id)->first();
        $acceso->wdocente = $datauser->wdoc2 . " " .$datauser->wdoc3. ", ".$datauser->wdoc1;  
        $acceso->save();

        Flash::success('Se ha modificado el usuario: '.$datauser->user_id.' : '.$acceso->wdocente.' de forma exitosa');
        //if(can('is_admin',Acceso::where('user_id',Session::get('user_id'))->first())){
        if(auth()->user()->can('is_admin',Acceso::class)){
            return redirect()->route('administrador.user.index');
        }else{
            return redirect()->back();
        }
    }
}
