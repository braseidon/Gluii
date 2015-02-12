<div class="row">
	<!-- First Name -->
	<div class="col-lg-6">
		{!! Form::group('first_name', 'Name', false, function($name)
		{ return Form::text($name, old('first_name', null), ['class' => 'form-control']); }) !!}
	</div>
	<!-- Last Name -->
	<div class="col-lg-6">
		{!! Form::group('last_name', 'Last Name', false, function($name)
		{ return Form::text($name, old('last_name', null), ['class' => 'form-control']); }) !!}
	</div>
</div>

<!-- Email -->
{!! Form::group('email', 'Email Address', false, function($name)
{ return Form::text($name, old('email', null), ['class' => 'form-control']); }) !!}

<!-- Password HaX0R-->
{!! Form::group('password', 'Password', false, function($name)
{ return Form::password($name, ['class' => 'form-control']); }) !!}

<!-- Password Confirmation -->
{!! Form::group('password_confirmation', 'Confirm Password', false, function($name)
{ return Form::password($name, ['class' => 'form-control']); }) !!}

<!-- Birthday -->
{!! Form::group('birthday', 'Birthday', false, function($name)
{
	return '<div class="row"><div class="col-lg-12"><div class="row no-gutter"><div class="col-md-4">'.
		Form::select('birthday_month', ['' => 'Month'] + formFill('months'), null, ['class' => 'form-control']) .
		'</div><div class="col-md-4">'.
		Form::select('birthday_day', ['' => 'Day'] + formFill('days'), null, ['class' => 'form-control']) .
		'</div><div class="col-md-4">'.
		Form::select('birthday_year', ['' => 'Year'] + formFill('years'), null, ['class' => 'form-control']) .
		'</div></div></div></div>';
}) !!}

<!-- Gender -->
{!! Form::group('gender', 'Gender', false, function($name)
{ return Form::select('gender', ['' => 'Select', 'male' => 'Male', 'female' => 'Female'], null, ['class' => 'form-control']); }) !!}

<hr>

<!-- Password Confirmation -->
{!! Form::group('agree_tos', false, false, function($name)
{ return Form::iCheckbox('agree_tos', 'I agree with the <a href="#">Terms and Conditions</a>'); }) !!}