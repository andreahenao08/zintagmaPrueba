@extends('layouts.app')

@section('title', "Candidato {$candidato->id}")

@section('content')

	<h1>Candidato #{{ $candidato->id }}</h1>

	<p>Nombres: {{ $candidato->nombres }}</p>

	<p>Apellidos: {{ $candidato->apellidos }}</p>

	<p>Correo: {{ $candidato->email }}</p>

	<p>Dirección: {{ $candidato->direccion }}</p>

	<p>Teléfono: {{ $candidato->telefono }}</p>

	<p>Nivel de Experiencia: {{ $candidato->experiencia }}</p>

	<p>Estado: {{ $candidato->estado }}</p>


	@if($candidato->imagen!=null)

		<a href='/download/{{ $candidato->imagen }}'>Descargar CV</a>
	
	@endif

	<form method="POST" action="{{ url('candidatos/'.$candidato->id) }}">
		{{  method_field('PUT') }}
		{!! csrf_field() !!}
		  <div class="form-group">
		  	<input type="hidden" name="nombres" value="{{ $candidato->nombres }}">
			<input type="hidden" name="email" value="{{ $candidato->email }}">
            <h2>Evalue:</h2>
            <select class="form-control" name="estado">
                  <option value="Llamar para entrevista">Llamar para entrevista</option>
                  <option value="Pendiente para próximas oportunidades">Pendiente para próximas oportunidades</option>
                  <option value="Rechazado">Rechazado</option>
            </select>
        </div>
	    <button type="submit" class="btn btn-primary">Guardar</button>
    </form>

	<p><a href="{{ route('candidatos')}}">Regresar</a></p>


@endsection
