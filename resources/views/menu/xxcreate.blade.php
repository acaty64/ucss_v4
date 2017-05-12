@extends('layouts.app')

@section('content')
    {!! Form::open(['route'=>'master.menu.store', 'method'=>'POST']) !!}
    <div class="form-group">
        {!! Field::text('Descripción: ',null, ['name'=>'name', 'class'=>'form-control', 'placeholder'=>'Nuevo Menú','required']) !!}
    </div>
    <div class="form-group">
        {!! Field::text('Ruta: ',null, ['name'=>'href', 'class'=>'form-control', 'placeholder'=>'/clase/accion','required']) !!}
    </div>
    <div class="form-group">
        {!! Field::number('Nivel: ', null, ['name'=>'level', 'class'=>'form-control', 'placeholder'=>0, 'range'=>'[0-5]', 'required']) !!}
    </div>
    <div class="form-group">
        {!! Field::number('Orden: ', null, ['name'=>'order', 'class'=>'form-control', 'placeholder'=>0, 'range'=>'[0-10]', 'required']) !!}
    </div>
    <?php foreach($types as $type){ ?>
        <input type='checkbox' name={{$type->name}} value={{$type->name}}> {{$type->name}}
        <br>
    <?php  }?>
    

    <div class="form-group">
        {!! Form::submit('Registrar', ['class'=>'btn btn-lg btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@endsection
@section('footer')
<p>create.index.blade.php</p>
@endsection