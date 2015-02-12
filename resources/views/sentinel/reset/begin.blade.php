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

			<div class="form-group{{ $errors->first('email', ' has-error') }}">

				<label for="email">Email</label>

				<input type="email" class="form-control" name="email" id="email" value="{{{ Input::old('email') }}}">

				<span class="help-block">{{{ $errors->first('email', ':message') }}}</span>

			</div>

			<hr>

			<div class="text-right">
				<button type="submit" class="btn btn-primary">Reset</button>
			</div>

		</form>

	</div>

</section>
@stop
