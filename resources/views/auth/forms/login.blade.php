	{{-- Email --}}
	{!! Form::group('email', 'Email', false, function($name)
	{ return Form::text($name, old('email'), ['class' => 'form-control']); }) !!}

	{{-- Password --}}
	{!! Form::group('password', 'Password', false, function($name)
	{ return Form::password($name, ['class' => 'form-control']); }) !!}

	{{-- Remember Me --}}
	{!! Form::groupOpen('remember') !!}
		{!! Form::iCheckbox('remember', 'Remember me') !!}
	{!! Form::groupClose('remember') !!}