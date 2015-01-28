<form class="" role="form" method="POST" action="{{ route('auth/register') }}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<!-- Name -->
	{!! Form::group('name', 'Name', false, function($name)
	{
		return Form::text($name, old('name'), ['class' => 'form-control']);
	}) !!}

	<!-- Email -->
	{!! Form::group('email', 'Email Address', false, function($name)
	{
		return Form::text($name, old('name'), ['class' => 'form-control']);
	}) !!}

	<!-- Password HaX0R-->
	{!! Form::group('password', 'Password', false, function($name)
	{
		return Form::password($name, ['class' => 'form-control']);
	}) !!}

	<!-- Password Confirmation -->
	{!! Form::group('password_confirmation', 'Confirm Password', false, function($name)
	{
		return Form::password($name, ['class' => 'form-control']);
	}) !!}

	<button type="submit" class="btn btn-primary btn-lg">
		Register
	</button>

</form>