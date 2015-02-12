@extends('layouts.master')

{{-- Page title --}}
@section('title', 'Login')

{{-- Inline styles --}}
@section('styles')
<link href="{{ URL::to('assets/css/auth.css') }}" rel="stylesheet">
<link href="{{ URL::to('assets/css/bootstrap.social.css') }}" rel="stylesheet">
@stop

{{-- Page content --}}
@section('page')
<section class="auth">

	<div class="col-sm-8 col-md-8 col-md-offset-2">

		<div class="auth__wall row">

			<div class="col-md-6">

				<div class="auth__profile">
					<img src="{{ URL::to('assets/img/brand-sentinel.svg') }}" alt="Profile Image">
				</div>

				<!-- Social logins -->

				<div class="auth__social">

					<h3>Sign in or register!</h3>

					@if (count($connections) > 0)
						<p>Fast and Simple authentication through OAuth 1 &amp; 2 service providers.</p>
						@foreach ($connections as $slug => $connection)
						<a href="{{ URL::to("oauth/authorize/{$slug}") }}" class="btn btn-social-icon btn-{{$slug}}"><i class="fa fa-{{$slug}} fa-lg"></i></a>
						@endforeach
					@else
						<p>No Social Connections configured.</p>
					@endif

					<hr class="visible-sm">

				</div>

			</div>

			<div class="col-md-6">

				<!-- Nav tabs -->
				<ul class="nav nav-tabs nav-justified nav-auth" role="tablist">
					<li class="active"><a href="#login" role="tab" data-toggle="tab">Login</a></li>
					<li><a href="#register" role="tab" data-toggle="tab">Register</a></li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">

					<div class="tab-pane active" id="login">
						@include('sentinel/login/form')
					</div>

					<div class="tab-pane" id="register">
						@include('sentinel/register/form')
					</div>

				</div>

			</div>

		</div>

	</div>

</section>
@stop
