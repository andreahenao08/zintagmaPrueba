@extends('layout')

@section('title', "Usuario {$user->id}")

@section('content')

	<h1>Usuario #{{ $user->id }}</h1>

	<p>Nombre: {{ $user->name }}</p>

	<p>Correo: {{ $user->email }}</p>

	<p>Estado: {{ $user->estado }}</p>

	<p><a href="{{ route('users')}}">Regresar</a></p>


@endsection
