<form class="form-horizontal" role="form" method="POST" action="{{ route('auth/login') }}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<!-- Email -->
	{!! Form::group('email', 'Email', [4,6], function($name)
	{
		return Form::text($name, old('email'), ['class' => 'form-control']);
	}) !!}

	<!-- Password -->
	{!! Form::group('password', 'Password', [4,6], function($name)
	{
		return Form::password($name, ['class' => 'form-control']);
	}) !!}

	<!-- Remember Me -->
	{!! Form::group('remember', null, [4,6], function($name)
	{
		return Form::iCheckbox('remember', 'Remember me');
	}) !!}

	<div class="form-group">
		<div class="col-md-6 col-md-offset-4">
			<button type="submit" class="btn btn-primary">
				Login
			</button>

			<a href="{{ route('auth/forgot-password') }}" class="btn btn-link">Forgot Your Password?</a>
		</div>
	</div>
</form>