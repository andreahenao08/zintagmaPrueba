@extends('layouts.app')

@section('title', "Candidato")

@section('content')

	<h1>{{ $title }}</h1>

@if($candidatos->isNotEmpty())
	<table class="table">
	  <thead class="thead-dark">
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Aspirante</th>
	      <th scope="col">Correo</th>
	      <th scope="col">Status</th>
	      <th scope="col">Acciones</th>
	    </tr>
	  </thead>
	  <tbody>
	@foreach($candidatos as $candidato)
	    <tr>
	      <th scope="row">{{ $candidato->id }}</th>
	      <td>{{ $candidato->nombres }}</td>
	      <td>{{ $candidato->email }}</td>
	      <td>{{ $candidato->estado }}</td>
	      <td>
				<form action="{{ route('candidatos.destroy', $candidato) }}" method="POST">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<a href="{{ route('candidatos.show',['id'=>$candidato->id])}}"><span class="oi oi-eye"></span></a> |
					<button type="submit" class="btn btn-link"><span class="oi oi-trash"></span></button>
				</form>
	      </td>
	    </tr>
	@endforeach
	  </tbody>
	</table>
@else
	<p>No hay postulaciones</p>
@endif

	
@endsection

@section('sidebar')
	@parent
@endsection