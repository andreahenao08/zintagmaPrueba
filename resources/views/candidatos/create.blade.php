@extends('layouts.app')

@section('title', "Cargar CV")

@section('content')

	<hr>

	@if ($errors->any())
	<div class="alert alert-danger">
		<h6>Por favor, corrige los siguientes errores:</h6>
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif
  <div class="row justify-content-center">
  <div class="col-md-10">
  <div class="card">
  <div class="card-header">-----Reclutamiento Zintagma-----</div>
  <div class="card-body">

	<form method="POST" action="{{ url('/candidatos') }}" accept-charset="UTF-8" enctype="multipart/form-data">

		{!! csrf_field() !!}

		<div class="form-group">
        <p>Datos Personales</p>
        <hr>
		    <label for="nombres">Nombres:</label>
		    <input type="text" class="form-control" name="nombres" id="nombres" placeholder="maria jose" value="{{ old('nombres') }}">
        </div>
        <div class="form-group">
		    <label for="apellidos">Apellidos:</label>
		    <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="perez perez" value="{{ old('apellidos') }}">
        </div>
        <p>Información de Contacto</p>
        <hr>
        <div class="form-group">
    		<label for="email">Correo electrónico:</label>
    		<input type="email" class="form-control" name="email" id="email" placeholder="mp@example.com" value="{{ old('email') }}">
  		</div>
  		<div class="form-group">
    		<label for="direccion">Dirección:</label>
    		<input type="text" class="form-control" name="direccion" id="direccion" placeholder="" value="{{ old('direccion') }}">
  		</div>
  		<div class="form-group">
    		<label for="telefono">Teléfono:</label>
    		<input type="text" class="form-control" name="telefono" id="telefono" placeholder="0XXX-XXXXXXX" value="{{ old('telefono') }}">
  		</div>
      <p>Acerca de sus intereses laborales</p>
      <hr>
      <div class="form-group">
          <label for="profession_id">Categoría Trabajo</label>
            <select class="form-control" name="profession_id" required="required">
                @foreach($professions as $profession)
                  <option value="{{ $profession->id }}"> {{ $profession->title }} </option>
                @endforeach
            </select>
      </div>
      <div class="form-group">
          <label>Experiencia</label>
            <select class="form-control" name="experiencia" required="required">
                  <option value="Profesional (< 3 años)">Profesional (< 3 años)</option>
                  <option value="Profesional (> 3 años)">Profesional (> 3 años)</option>
                  <option value="Estudiante">Estudiante</option>
                  <option value="Ninguna">Ninguna</option>
            </select>
        </div>
  		<div class="form-group">
    		<label for="salarioEsperado">Salario Esperado:</label>
    		<input type="number" name="salarioEsperado" min="100" max="1000" step="50"  required="required">
  		</div>
      <p>Adjuntar CV</p>
      <div class="form-group">
              <label for="imagen"></label>
              <input type="file" class="form-control" name="imagen" >
      </div>

  		<button type="submit" class="btn btn-primary">Guardar</button>

  		<a href="{{ route('candidatos')}}" class="btn btn-link">Regresar</a>

	</form>

  </div>
  </div>
  </div>
  </div>
  </div>

@endsection