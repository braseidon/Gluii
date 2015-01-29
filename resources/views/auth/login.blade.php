@extends('template.master')

@section('title')
	Sign In
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">

		</div>
		<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
			@include('auth.partials.login')
		</div>
	</div>
@endsection