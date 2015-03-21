@extends('account.template.template')

@section('title', 'Update Email')

@section('content')
	<section class="panel panel-default">
		<div class="panel-body">
			<h4 class="page-header m-t-none">Update Your Login Email</h4>

			<div class="alert alert-warning">
				<p>In order to change your email, you must confirm the new email address.</p>
			</div>

			<form action="{{ route('account/security/update-email') }}" method="POST">
				{{-- New Email --}}
				{!! Form::group('email', 'New Email Address', false, function($name)
				{ return Form::text($name, old('email'), ['class' => 'form-control', 'autocomplete' => 'false']); }) !!}

				{{-- Confirm New Email --}}
				{!! Form::group('email-confirm', 'Confirm Email Address', false, function($name)
				{ return Form::text($name, old('email-confirm'), ['class' => 'form-control', 'autocomplete' => 'false']); }) !!}

				{!! Form::token() !!}
				<button type="submit" class="btn btn-primary">Update Email Address</button>
			</form>
		</div>
	</section>
@stop
