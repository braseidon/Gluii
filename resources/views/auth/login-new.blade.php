@extends('auth.template.master')

@section('title')
	Login
@stop

@section('content')
	<form class="form-validation" id="form" name="form">
		<div class="text-danger wrapper text-center"></div>
		<div class="list-group list-group-sm">
			<div class="list-group-item">
				<input class="form-control no-border" placeholder="Name" required="">
			</div>
			<div class="list-group-item">
				<input class="form-control no-border" placeholder="Email" required="" type="email">
			</div>
			<div class="list-group-item">
				<input class="form-control no-border" placeholder="Password" required="" type="password">
			</div>
		</div>
		<div class="checkbox m-b-md m-t-none">
			<label class="i-checks">
				<input required="" type="checkbox">
					<i></i> Agree the <a href="">terms and policy</a>
			</label>
		</div>

		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>

		<div class="line line-dashed"></div>

		<p class="text-center">
			<small>Already have an account?</small>
		</p>
		<a class="btn btn-lg btn-default btn-block">Sign in</a>
	</form>
@stop