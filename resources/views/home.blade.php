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
                        <label for="sel_facu">Seleccione la facultad:</label>
                        <select class="form-control" id="sel_facu" name="sel_facu">
                          <?php 
                              $facultades = \App\facultad::all();
                          ?>
                          @foreach ($facultades as $facultad)
                              <option id={!! $facultad->id !!}>{!! $facultad->wfacultad !!}</option>;
                          @endforeach
                        </select>
                        <br>
                        <label for="sel_sede">Seleccione la sede:</label>
                        <select class="form-control" id="sel_sede" name="sel_sede">
                          <?php 
                              $sedes = \App\sede::all();
                          ?>
                          @foreach ($sedes as $sede)
                              <option id={!! $sede->id !!}>{!! $sede->wsede !!}</option>;
                          @endforeach
                        </select>
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