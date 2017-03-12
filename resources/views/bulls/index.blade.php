@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					Toros, {{ count($bulls) }}
					<a href="{{ route('bulls.create') }}">Agregar nuevo toro</a>
				</div>
				<div class="panel-body">
				</div>
			</div>
		</div>
	</div>
</div>
@endsection