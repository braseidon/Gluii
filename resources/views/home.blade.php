@extends('template.master')

@section('title')
	Welcome to Gluii
@endsection

@section('content')
	<div class="row">
		<!-- left column -->
		<div class="col-lg-6">
			<h3>Reconnect with the family you meet at festivals around the world.</h3>
		</div>
		<!-- right column -->
		<div class="col-lg-5 col-lg-offset-1">
			<h2 class="m-t-none">Sign up. <span class="font-thin">It's free!</span></h2>
			@include('auth.forms.register')
		</div>
	</div>
@endsection