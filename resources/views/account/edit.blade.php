@extends('layouts.master')

{{-- Page title --}}
@section('title', 'Update Profile')

{{-- Page content --}}
@section('page')
<section class="user">

	<header class="page-header">
		<h1>Update your profile</h1>
	</header>

	<div class="col-sm-6 col-md-6 col-md-offset-3">

		<form method="post" action="" autocomplete="off" class="validate-form">

			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<!-- Hack to completely disable autocompletion -->
			<input type="text" style="display: none;">
			<input type="password" style="display: none;">

			<div class="form-group{{ $errors->first('first_name', ' has-error') }}">

				<label for="first_name">First Name</label>

				<input type="text" class="form-control" name="first_name" id="first_name" value="{{{ Input::old('first_name', $currentUser->first_name) }}}" placeholder="Enter your first name.">

				<span class="help-block">{{{ $errors->first('first_name', ':message') }}}</span>

			</div>

			<div class="form-group{{ $errors->first('last_name', ' has-error') }}">

				<label for="name">Last Name</label>

				<input type="text" class="form-control" name="last_name" id="last_name" value="{{{ Input::old('last_name', $currentUser->last_name) }}}" placeholder="Enter your last name.">

				<span class="help-block">{{{ $errors->first('last_name', ':message') }}}</span>

			</div>

			<div class="form-group{{ $errors->first('email', ' has-error') }}">

				<label for="email">Email</label>

				<input class="form-control" name="email" type="email" placeholder="Enter the user email." value="{{{ Input::old('email', $currentUser->email) }}}" required autofocus data-bv-emailaddress-message="The input is not a valid email address" />

				<span class="help-block">{{{ $errors->first('email', ':message') }}}</span>

			</div>

			<div class="form-group{{ $errors->first('password', ' has-error') }}">

				<label for="password">Password</label>

				<input type="password" class="form-control" name="password" id="password" value="" placeholder="Enter the user password (only if you want to modify it)." {{ ! $currentUser->exists ? ' required' : null }} data-bv-identical="true" />

				<span class="help-block">{{{ $errors->first('password', ':message') }}}</span>

			</div>

			<div class="form-group{{ $errors->first('password_confirm', ' has-error') }}">

				<label for="password_confirm">Confirm Password</label>

				<input class="form-control" name="password_confirm" type="password" placeholder="Confirm Password"
					data-bv-identical="true"
					data-bv-identical-field="password"
					data-bv-identical-message="The password and its confirmation are not the same!"
				/>

				<span class="help-block">{{{ $errors->first('password_confirm', ':message') }}}</span>

			</div>

			<hr>

			<div class="text-right">

				<a class="btn btn-default" href="{{ URL::route('user.account') }}">Cancel</a>

				<button type="submit" class="btn btn-primary">Save</button>

			</div>

		</form>

	</div>

</section>
@stop
