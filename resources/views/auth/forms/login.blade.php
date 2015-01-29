	<!-- Email -->
	{!! Form::group('email', 'Email', false, function($name)
	{ return Form::text($name, old('email'), ['class' => 'form-control']); }) !!}

	<!-- Password -->
	{!! Form::group('password', 'Password', false, function($name)
	{ return Form::password($name, ['class' => 'form-control']); }) !!}

	<hr>

	<!-- Remember Me -->
	{!! Form::group('remember', null, false, function($name)
	{ return Form::iCheckbox('remember', 'Remember me'); }) !!}