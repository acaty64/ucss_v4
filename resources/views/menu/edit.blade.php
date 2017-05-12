@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edición de Menú</div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <th>id</th>
                            <th>Tipo</th>
                            <th>Menú</th>
                            <th>Ruta</th>
                            <th>Nivel</th>
                            <th>Orden</th>
                            <th>Acción</th>
                        </thead>
                        <tbody>  
                            <?php foreach($menus as $menu => $key){ ?>
                               <tr> 
                                    <td>{{$menu->menu_id}}</td>
                                    <td>{{$menu->type_name}}</td>
                                    <td>{{$menu->menu_name}}</td>
                                    <td>{{$menu->menu_href}}</td>
                                    <td>{{$menu->level}}</td>
                                    <td>{{$menu->order}}</td>
                                    <td>Botón de grabar</td>
                               </tr>
                            <?php } ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer')
<p>master.index.blade.php</p>
<p><a class="btn btn-link" href="{{ url('/prueba1') }}">
    PRUEBA 1. Session::all()
</a></p>
<p><a class="btn btn-link" href="{{ url('/prueba2') }}">
    PRUEBA 2. Auth::user()
</a></p>
@endsection