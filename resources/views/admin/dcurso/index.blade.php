@extends('template.main')

@section('title','Prioridad de Docentes del curso '.$curso->wcurso)

@section('content')
	<a href="{{ route('admin.cursogrupo.index',$grupo_id)}}" class="btn btn-info pull-right">Regresar al índice</a>

 	<div id="app"> 
		<form @@submit="signUp(false, $event)">

	      	<button type="submit" class="btn btn-info pull-left" v-if="saving">
	          	Grabar modificaciones
	      	</button>

		</form>
		
 		<input type="text" v-model="curso_id" value={{$curso->id}} hidden="hidden">				
 		<input type="text" v-model="grupo_id" value={{$grupo_id}} hidden="hidden">
 		<input type="text" v-model="facultad_id" value={{Session::get('facultad_id')}} hidden="hidden">								
 		<input type="text" v-model="sede_id" value={{Session::get('sede_id')}} hidden="hidden">	
							
		<table class="table table-striped">
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
                  <registro :id="registro.id" :cdocente="registro.cdocente" :wdocente="registro.wdocente" :prioridad.sync="registro.prioridad" :registros.sync="registros"></registro>
              </template>
            </tbody>
		</table>
		

		<!--pre>
			@{{ $data | json }}
		</pre-->


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
		<script src={{url("js/jquery-3.2.1.min.js")}} ></script>
	    <script src={{url("js/vue.js")}} ></script>
	    <script src={{url("js/vue-resource.min.js")}} ></script>
	    <script src={{url("js/dcurso.js")}} ></script>
 	</div>

@endsection

@section('view','admin/dcurso/index.blade.php')