@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Acceso Admitido</div>

                <div class="panel-body">
                    <p>Logueo correcto</p>
                    <p>Type: {{Session::get('ctype')}}</p> 
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer')
ok.blade.php
<p><a class="btn btn-link" href="{{ url('/prueba1') }}">
    PRUEBA 1. Session::all()
</a></p>
<p><a class="btn btn-link" href="{{ url('/prueba2') }}">
    PRUEBA 2. Auth::user()
</a></p>
@endsection