@extends('template.master')

@section('title')
	Join the Family
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">

		</div>
		<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
			@include('auth.partials.register')
		</div>
	</div>
@endsection