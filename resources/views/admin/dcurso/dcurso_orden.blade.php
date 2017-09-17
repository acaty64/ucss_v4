@extends('template.main')

@section('title','Prioridad de Docentes del curso '.$curso->wcurso)

@section('content')
  <div id="app">
    <form @@submit="signUp(false, $event)">
      <table class="table table-striped table-condensed table-hover">
        <thead>
          <tr>
            <th>Id</th>
            <th>Código</th>
            <th>Docente</th>
            <th>Prioridad</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <template v-for="registro in registros | orderBy 'prioridad'">
              <registro :id="registro.id" :cdocente="registro.cdocente" :wdocente="registro.wdocente" :prioridad.sync="registro.prioridad" :registros.sync="registros">
          </template>
        </tbody>
      </table>

      <hr>

      <button type="submit" class="btn btn-primary">
          Regístrate
      </button>

      <button type="submit" class="btn btn-primary" @@click="signUp(true, $event)">
          Regístrate y sal del sistema
      </button>
    </form>

    <hr>

    <pre>@{{ $data | json }}</pre>
    

    @verbatim
      <script type="text/template" id="registro_template">
        <tr>
          <td>{{id}}</td> 
          <td>{{cdocente}}</td>
          <td>{{wdocente}}</td>  
          <td>{{prioridad}}</td>

          <td>
              <button type="button"
                      class="btn glyphicon glyphicon-chevron-up"
                      data-toggle="tooltip"
                      title="Subir un nivel"
                      :disabled="prioridad == 1"
                      @click="up"></button>
              <button type="button"
                      class="btn glyphicon glyphicon-triangle-top"
                      data-toggle="tooltip"
                      title="Prioridad máxima"
                      :disabled="prioridad == 1"
                      @click="top"></button>
              <button type="button"
                      class="btn glyphicon glyphicon-chevron-down"
                      data-toggle="tooltip"
                      title="Bajar un nivel"
                      @click="down"></button>
              <button type="button"
                      class="btn glyphicon glyphicon-triangle-bottom"
                      data-toggle="tooltip"
                      title="Prioridad mínima"
                      @click="bottom"></button>
          </td>
        </tr>
      </script>
    @endverbatim
    <script src={{url("js/vue.js")}}></script>
    <script src={{url("js/dcurso.js")}}></script>
  </div>
@endsection

@section('view','PRUEBA admin/dcurso/dcurso_orden.blade.php')

@section('js')

  

@endsection
