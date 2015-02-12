@extends('layouts.master')

{{-- Page title --}}
@section('title', 'Reset Password')

{{-- Page content --}}
@section('page')
<section class="reset-password">

	<div class="page-header">
		<h1>Reset Password</h1>
	</div>

	<div class="col-sm-6 col-md-6 col-md-offset-3">

		<form method="post" action="" autocomplete="off" class="validate-form">

			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="form-group{{ $errors->first('password', ' has-error') }}">

				<label for="password">New Password</label>

				<input type="password" class="form-control" name="password" id="password" value="{{{ Input::old('password') }}}">

				<span class="help-block">{{{ $errors->first('password', ':message') }}}</span>

			</div>

			<div class="form-group{{ $errors->first('password_confirmation', ' has-error') }}">

				<label for="password-confirmation">Confirm New Password</label>

				<input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="{{{ Input::old('password_confirmation') }}}">

				<span class="help-block">{{{ $errors->first('password_confirmation', ':message') }}}</span>

			</div>

			<hr>

			<div class="text-right">

				<button type="submit" class="btn btn-primary">Reset</button>
			</div>

		</form>

	</div>

</section>
@stop
