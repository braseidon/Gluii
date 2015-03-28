@if(! Auth::check())
	<section class="panel panel-default">
		<div class="panel-heading font-bold">
			Reset Password
		</div>
		<form method="POST" action="{{ route('auth/forgot-password') }}" role="form">
			<div class="panel-body">
				<!-- Reset Password Form -->
				<p>Enter your email address associated with your account to reset your password.</p>

				<!-- Email -->
				{!! Form::group('email', 'Email', false, function($name)
				{ return Form::text($name, old('email'), ['class' => 'form-control']); }) !!}
			</div>
			<footer class="panel-footer">
				{{-- CSRF --}}
				{!! Form::token() !!}
				<button type="submit" class="btn btn-primary">Reset Password</button>
			</footer>
		</form>
	</section>
@endif