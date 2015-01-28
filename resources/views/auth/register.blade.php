@extends('template.master')

@section('title')
	Join the Family
@endsection

@section('content')
		<div class="row">
			<div class="col-md-12">
@extends('template.master')

@section('title')
	Welcome to Gluii
@endsection

@section('content')
	<div class="panel-body">
		<div class="row no-gutter text-center">
			<div class="col-lg-12">
				<h2>Reconnect with the family you meet at festivals around the world.</h2>
				<h3 class="m-t-none">Sign up. <span class="font-thin">It's free!</span></h3>
			</div>
		</div>
		<div class="row">
			<!-- right column -->
			<div class="col-lg-6 col-lg-offset-3">
				<form method="POST" action="{{ route('auth/register') }}" role="form">
					@include('auth.forms.register')
				</form>
			</div>
		</div>
	</div>
@endsection