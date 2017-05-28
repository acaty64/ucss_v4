@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Facultad y Sede</div>

                <div class="panel-body">
                    
                    {!! Form::open(['method' => 'POST', 'route' => 'home.acceso'])!!}
                      <div class="form-group">
                        {!! Form::select('facultad_id',$opc_facu, null, ['class'=>'form-control',  'placeholder'=>'Seleccione la facultad','required']) !!}
                        <br>
                        {!! Form::select('sede_id',$opc_sede, null, ['class'=>'form-control',  'placeholder'=>'Seleccione la sede','required']) !!}
                        <br>
                      </div>
                      <button type="submit">Acceder</button>

                  {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
home.blade.php
@endsection