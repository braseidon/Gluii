@extends('account.template.template')

@section('title', 'Update Password')

@section('content')
	<section class="panel panel-default">
		<div class="panel-body">
			<h4 class="page-header m-t-none">Update Your Password</h4>

			<form action="{{ route('account/security/update-password') }}" method="POST">
				{{-- New Password --}}
				{!! Form::group('password', 'New Password Address', false, function($name)
				{ return Form::text($name, old('password'), ['class' => 'form-control', 'autocomplete' => 'false']); }) !!}

				{{-- Confirm New Password --}}
				{!! Form::group('password-confirm', 'Confirm Password Address', false, function($name)
				{ return Form::text($name, old('password-confirm'), ['class' => 'form-control', 'autocomplete' => 'false']); }) !!}

				{!! Form::token() !!}
				<button type="submit" class="btn btn-primary">Update Password Address</button>
			</form>
		</div>
	</section>
@stop
