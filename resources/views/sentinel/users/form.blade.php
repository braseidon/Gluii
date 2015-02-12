@extends('layouts.master')

{{-- Page content --}}
@section('page')
<section class="user">

	<header class="page-header">
		<h1>{{ $mode == 'create' ? 'Create User' : 'Update User' }} <small>{{ $user->name }}</small></h1>
	</header>

	<div class="col-sm-6 col-md-6 col-md-offset-3">

		<form method="post" action="" autocomplete="off" class="validate-form">

			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<h2>Profile</h2>

			<div class="form-group{{ $errors->first('first_name', ' has-error') }}">

				<label for="first_name">First Name</label>

				<input type="text" class="form-control" name="first_name" id="first_name" value="{{{ Input::old('first_name', $user->first_name) }}}" placeholder="Enter the users first name.">

				<span class="help-block">{{{ $errors->first('first_name', ':message') }}}</span>

			</div>

			<div class="form-group{{ $errors->first('last_name', ' has-error') }}">

				<label for="name">Last Name</label>

				<input type="text" class="form-control" name="last_name" id="last_name" value="{{{ Input::old('last_name', $user->last_name) }}}" placeholder="Enter the users last name.">

				<span class="help-block">{{{ $errors->first('last_name', ':message') }}}</span>

			</div>

			<div class="form-group{{ $errors->first('email', ' has-error') }}">

				<label for="email">Email</label>

				<input class="form-control" name="email" type="email" placeholder="Enter the user email." value="{{{ Input::old('email', $user->email) }}}" required autofocus data-bv-emailaddress-message="The input is not a valid email address" />

				<span class="help-block">{{{ $errors->first('email', ':message') }}}</span>

			</div>

			<div class="form-group{{ $errors->first('roles', ' has-error') }}">

				<label for="roles">Roles</label>

				<select class="form-control" name="roles[]" id="roles[]" multiple="multiple">
					@foreach ($roles as $role)
					<option value="{{ $role->id }}"{{ array_key_exists($role->id, $userRoles) ? ' selected="selected"' : null }}>{{ $role->name }}</option>
					@endforeach
				</select>

				<span class="help-block">{{{ $errors->first('roles', ':message') }}}</span>

			</div>

			<h2>Security</h2>

			<div class="form-group{{ $errors->first('password', ' has-error') }}">

				<label for="password">Password</label>

				<input type="password" class="form-control" name="password" id="password" value="" placeholder="Enter the user password (only if you want to modify it)." data-bv-identical="true" />

				<span class="help-block">{{{ $errors->first('password', ':message') }}}</span>

			</div>

			<div class="form-group{{ $errors->first('password_confirm', ' has-error') }}">

				<label for="password_confirm">Confirm Password</label>

				<input class="form-control" name="password_confirm" id="password_confirm" type="password" placeholder="Confirm Password"
					data-bv-identical="true"
					data-bv-identical-field="password"
					data-bv-identical-message="The password and its confirmation are not the same!"
				/>

				<span class="help-block">{{{ $errors->first('password_confirm', ':message') }}}</span>

			</div>

			<hr>

			<div class="text-right">

				@if ($user->exists && Sentinel::hasAccess('admin') && $currentUser->id != $user->id)

				@if (Activation::completed($user))
				<a class="btn btn-warning" href="{{ URL::route('user.deactivate', $user->id) }}">Deactivate</a>
				@else
				<a class="btn btn-primary" href="{{ URL::route('user.reactivate', $user->id) }}">Activate</a>
				@endif

				<form class="form-inline" method="post" action="{{ URL::route('user.delete', $user->id) }}">
					{{-- CSRF Token --}}
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button class="btn btn-danger">Delete</button>
				</form>

				@endif

				<a class="btn btn-default" href="{{ URL::route('users.index') }}">Cancel</a>

				<button type="submit" class="btn btn-primary">Save</button>

			</div>

		</form>

	</div>

</section>
@stop
