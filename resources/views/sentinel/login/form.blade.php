<form action="{{ URL::to('login') }}" method="post" class="auth__form form-horizontal validate-form"
	data-bv-message="This value is not valid"
	data-bv-feedbackicons-valid="fa fa-check-sqaure-o fa-lg"
	data-bv-feedbackicons-invalid="fa fa-warning"
	data-bv-feedbackicons-validating="fa fa-refresh">

	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<div class="form-group">
		<input class="form-control" name="email" type="email" placeholder="Email" required autofocus data-bv-emailaddress-message="The input is not a valid email address" />
	</div>

	<div class="form-group">
		<input class="form-control" name="password" type="password" placeholder="Password" required data-bv-password-message="A password is required" />
	</div>

	<div class="form-group">
		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
	</div>

	<div class="form-group">
		<a href="{{ URL::to('reset') }}">Forgot password?</a>
	</div>

	<div class="form-group">
		<span class="bg-switch">
			<input type="checkbox" id="remember" name="remember" class="sw">
			<label class="switch bg-primary" for="remember"><span class="bg_circle"></span>
			</label>
		</span>
		<h6>Remember Me</h6>
	</div>

</form>
