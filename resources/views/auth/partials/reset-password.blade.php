@if(! Auth::check())
	<section class="panel panel-default">
		<div class="panel-heading font-bold">
			Reset Password
		</div>
		<form method="POST" action="{{ route('auth/reset-password', [$userId, $code]) }}" role="form">
			<div class="panel-body">
				<!-- Reset Password Form -->
				<p>Enter a new password for your account.</p>

				<!-- Password HaX0R-->
				{!! Form::group('password', 'Password', false, function($name)
				{ return Form::password($name, ['class' => 'form-control']); }) !!}

				<!-- Password Confirmation -->
				{!! Form::group('password_confirmation', 'Confirm Password', false, function($name)
				{ return Form::password($name, ['class' => 'form-control']); }) !!}
			</div>
			<footer class="panel-footer">
				{{-- CSRF --}}
				{!! Form::token() !!}
				<button type="submit" class="btn btn-primary">Reset Password</button>
			</footer>
		</form>
	</section>
@endif