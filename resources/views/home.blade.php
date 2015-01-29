@extends('template.master')

@section('title')
	Welcome to Gluii
@endsection

@section('content')
	<div class="row no-gutter text-center">
		<div class="col-lg-12">
			<!-- <img src="/images/slides/eletric_forest_banner.jpg" class="img-full" /> -->
		</div>
	</div>
	<div class="row">
		<!-- left column -->
		<div class="col-lg-7">
			<h2 class="m-b">Reconnect with the family</h2>
			<h3 class="m-t-none">you've been meeting at festivals around the globe</h3>
		</div>
		<!-- right column -->
		<div class="col-lg-5">
			@include('auth.partials.register')
		</div>
	</div>
@endsection