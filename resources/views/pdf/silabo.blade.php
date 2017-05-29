@extends('template.main')

@section('title','SILABO DEL CURSO: '.$wcurso)

@section('content')
	<object data={{$arch_pdf}} type="application/pdf" width=100% height=800 margin-left:auto margin-right:auto>
	  Su navegador no soporta pdfs, <a href={{$arch_pdf}}>haga click aqui para descargar el archivo.</a>
	</object>
@endsection

@section('view','pdf/silabo.blade.php')	