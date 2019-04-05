@extends('layouts.app')

@section('title', "Candidato {$candidato->id}")

@section('content')

	<h1>Candidato #{{ $candidato->id }}</h1>
		<p>Nombre: {{ $candidato->nombres }}
		<p>Correo: {{ $candidato->email }}


@endsection
