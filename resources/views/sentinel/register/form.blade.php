<form action="{{ URL::to('register') }}" method="post" class="auth__form form-horizontal validate-form"
	data-bv-message="This value is not valid"
	data-bv-feedbackicons-valid="fa fa-check-sqaure-o fa-lg"
	data-bv-feedbackicons-invalid="fa fa-warning"
	data-bv-feedbackicons-validating="fa fa-refresh">

	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<div class="form-group">
		<input class="form-control" name="email" type="email" placeholder="Email" required autofocus data-bv-emailaddress-message="The input is not a valid email address" />
	</div>

	<div class="form-group">
		<input class="form-control" name="password" type="password" placeholder="Password" required
		data-bv-notempty="true"
		data-bv-notempty-message="The password is required and cannot be empty" />
	</div>

	<div class="form-group">
		<input class="form-control" name="password_confirm" type="password" placeholder="Confirm Password" required
		data-bv-notempty="true"
		data-bv-notempty-message="The password is required and cannot be empty"

		data-bv-identical="true"
		data-bv-identical-field="password"
		data-bv-identical-message="The password and its confirm are not the same" />
	</div>

	<div class="form-group">
		<button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
	</div>

</form>
