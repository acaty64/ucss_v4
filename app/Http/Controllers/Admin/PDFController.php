<?php

namespace App\Http\Controllers\Admin;

use App\Curso;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\asset;
use Illuminate\Support\Facades\Session;

class PDFController extends Controller
{
    public function usuario($user_id)
    {
    	$view_user = User::find($user_id)->toArray();
        $datauser = User::find($user_id)->datauser()->get()->toArray();
    	$view = \View::make('pdf.usuario', compact('view_user','datauser'))->render();
    	$pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('usuario');
    }

    public function silaboCurso(Request $request)
    {
        $curso = Curso::find($request->curso_id);
        $filename = $curso->ccurso.'.pdf';
        $facu_sede = Session::get('cfacultad').'_'.Session::get('csede');
        $file_pdf = 'pdf/FCEC_LIM/silabos/'.$filename;
        $arch_pdf = asset('pdf\\'.$facu_sede.'\\silabos\\').$filename;
        if(!file_exists($file_pdf)){
            $arch_pdf = asset('pdf\\000000.pdf');
        }
        return view('pdf.silabo')
            ->with('arch_pdf',$arch_pdf)
            ->with('wcurso',$curso->wcurso);
    }

}
