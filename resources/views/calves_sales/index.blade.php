@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">Ventas</div>
				<div class="panel-body">

					<div class="row">
						<div class="col-lg-6">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Buscar...">
								<span class="input-group-btn">
									<button class="btn btn-default btn-info" type="button">Buscar</button>
								</span>
							</div>
						</div>
					</div>

				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">Becerros ({{ count($calves) }})</div>
				<div class="panel-body">
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection