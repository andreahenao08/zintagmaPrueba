@extends('layout')

@section('title', "Usuario")

@section('content')

	<h1>{{ $title }}</h1>

@if($users->isNotEmpty())
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
	@foreach($users as $user)
	    <tr>
	      <th scope="row">{{ $user->id }}</th>
	      <td>{{ $user->name }}</td>
	      <td>{{ $user->email }}</td>
	      <td>{{ $user->estado }}</td>
	      <td>
				<form action="{{ route('users.destroy', $user) }}" method="POST">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<a href="{{ route('users.show',['id'=>$user->id])}}"><span class="oi oi-eye"></span></a> |
					<a href="{{ route('users.show',['id'=>$user->id])}}"><span class="oi oi-check"></span></a> |
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