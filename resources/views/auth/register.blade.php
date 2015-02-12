@extends('template.master')

@section('title', 'Join the Family')

@section('content')
	<div class="row">
		<div class="col-sm-12 col-md-6 col-lg-7 hidden-xs">

		</div>
		<div class="col-sm-12 col-md-6 col-lg-5">
			@include('auth.partials.register')
		</div>
	</div>
@endsection