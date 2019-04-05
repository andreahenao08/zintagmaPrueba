<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Listado de candidatos</title>
</head>
<body>
	<h1>{{ $title}}</h1>

	<hr>

	@if(!empty($candidatos))
		<ul>
			@foreach ($candidatos as $candidato)
				<li>{{ $candidato}}</li>
			@endforeach
		</ul>
	@else
		<p>No hay postulaciones</p>
	@endif
</body>
</html>