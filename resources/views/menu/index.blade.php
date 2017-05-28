@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Menu Index</div>
                <div class="panel-body">
                    <a href="{{ route('master.menu.create') }}" class="btn btn-info" id='NuevoMenu'>Crear Nuevo Menu</a>
                    <table class="table table-striped">
                        <thead>
                            <th>id</th>
                            <th>Menú</th>
                            <th>Ruta</th>
                            <th>Acción</th>
                        </thead>
                        <tbody>
                        @foreach($menus as $menu)
                            <tr>
                                <td>{{ $menu->id }}</td>
                                <td>{{ $menu->name }}</td>
                                <td>{{ $menu->href }}</td>
                                <td>
                                    <a href="{{ route('master.menu.edit', $menu->id) }}" class="btn btn-warning" data-toggle="tooltip" title="Modificar menu" name = "{{'Mody'.$menu->id}}"><span class="glyphicon glyphicon-wrench" aria-hidden='true'></span></a>
                                    <a href="{{ route('master.menu.delete', $menu->id) }}" onclick='return confirm("Está seguro de eliminar el registro?")' class="btn btn-danger" data-toggle="tooltip" title="Eliminar menu" name = "{{'Dele'.$menu->id}}"><span class="glyphicon glyphicon-trash" aria-hidden='true'></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $menus->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer')
<p>menu.index.blade.php</p>
<p><a class="btn btn-link" href="{{ url('/prueba1') }}">
    PRUEBA 1. Session::all()
</a></p>
<p><a class="btn btn-link" href="{{ url('/prueba2') }}">
    PRUEBA 2. Auth::user()
</a></p>
@endsection