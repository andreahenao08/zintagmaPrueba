@extends('layout')

@section('title', "Crear usuario")

@section('content')

	<h1>Crear Usuario</h1>

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

	<form method="POST" action="{{ url('usuarios/') }}">

		{!! csrf_field() !!}

		<div class="form-group">
		    <label for="name">Nombre</label>
		    <input type="text" class="form-control" name="name" id="name" placeholder="maria perez" value="{{ old('name') }}">
        </div>
        <div class="form-group">
    		<label for="email">Correo electrónico</label>
    		<input type="email" class="form-control" name="email" id="email" placeholder="mp@example.com" value="{{ old('email') }}">
  		</div>
        <div class="form-group">
    		<label for="password">Contraseña</label>
    		<input type="password" class="form-control" name="password" id="password" placeholder="Password">
  		</div>
  		<!--div class="form-group form-check">
    		<input type="checkbox" class="form-check-input" id="exampleCheck1">
    		<label class="form-check-label" for="exampleCheck1">Check me out</label>
  		</div-->
  		<button type="submit" class="btn btn-primary">Crear usuario</button>

  		<a href="{{ route('users') }}" class="btn btn-link">Regresar</a>

	</form>

@endsection