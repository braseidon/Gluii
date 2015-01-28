@extends('template.master')

@section('title')
	Login
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Login</div>
					<div class="panel-body">
						@include('auth.forms.login')
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection