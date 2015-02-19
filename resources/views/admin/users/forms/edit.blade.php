<!-- left column -->
<div class="col-md-6">
	<h3 class="page-header m-t-none text-muted">Profile</h3>

	<!-- first name -->
	<div class="form-group{{ $errors->first('first_name', ' has-error') }}">
		<label for="first_name">First Name</label>
		<input type="text" class="form-control" name="first_name" id="first_name" value="{{{ Input::old('first_name', $user->first_name) }}}" placeholder="Enter the users first name.">
		<span class="help-block">{{{ $errors->first('first_name', ':message') }}}</span>
	</div>

	<!-- last name -->
	<div class="form-group{{ $errors->first('last_name', ' has-error') }}">
		<label for="name">Last Name</label>
		<input type="text" class="form-control" name="last_name" id="last_name" value="{{{ Input::old('last_name', $user->last_name) }}}" placeholder="Enter the users last name.">
		<span class="help-block">{{{ $errors->first('last_name', ':message') }}}</span>
	</div>

	<!-- roles -->
	<div class="form-group{{ $errors->first('roles', ' has-error') }}">
		<label for="roles">Roles</label>
		<select class="form-control" name="roles[]" id="roles[]" multiple="multiple">
			@foreach ($roles as $role)
			<option value="{{ $role->id }}"{{ array_key_exists($role->id, $userRoles) ? ' selected="selected"' : null }}>{{ $role->name }}</option>
			@endforeach
		</select>
		<span class="help-block">{{{ $errors->first('roles', ':message') }}}</span>
	</div>
</div>
<!-- right column -->
<div class="col-md-6">
	<h3 class="page-header m-t-none text-muted">Login &amp; Security</h3>

	<!-- email -->
	<div class="form-group{{ $errors->first('email', ' has-error') }}">
		<label for="email">Email</label>
		<input class="form-control" name="email" type="email" placeholder="Enter the user email." value="{{{ Input::old('email', $user->email) }}}" required autofocus data-bv-emailaddress-message="The input is not a valid email address" />
		<span class="help-block">{{{ $errors->first('email', ':message') }}}</span>
	</div>

	<!-- password -->
	<div class="form-group{{ $errors->first('password', ' has-error') }}">
		<label for="password">Password</label>
		<input type="password" class="form-control" name="password" id="password" value="" placeholder="Enter the user password (only if you want to modify it)." data-bv-identical="true" />
		<span class="help-block">{{{ $errors->first('password', ':message') }}}</span>
	</div>

	<!-- password confirm -->
	<div class="form-group{{ $errors->first('password_confirm', ' has-error') }}">
		<label for="password_confirm">Confirm Password</label>
		<input class="form-control" name="password_confirm" id="password_confirm" type="password" placeholder="Confirm Password"
			data-bv-identical="true"
			data-bv-identical-field="password"
			data-bv-identical-message="The password and its confirmation are not the same!"/>
		<span class="help-block">{{{ $errors->first('password_confirm', ':message') }}}</span>
	</div>
</div>