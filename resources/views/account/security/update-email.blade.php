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
				{{-- Current Email --}}
				{!! Form::groupOpen('', 'Current Email Address') !!}
					{!! Form::text('', Auth::getUser()->email, ['class' => 'form-control disabled', 'disabled']) !!}
				{!! Form::groupClose('') !!}
				{{-- New Email --}}
				{!! Form::groupOpen('email', 'New Email Address') !!}
					{!! Form::text('email', old('email'), ['class' => 'form-control', 'autocomplete' => 'false']) !!}
				{!! Form::groupClose('email') !!}
				{{-- Confirm New Email --}}
				{!! Form::groupOpen('email_confirm', 'Confirm New Email Address') !!}
					{!! Form::text('email_confirm', old('email_confirm'), ['class' => 'form-control', 'autocomplete' => 'false']) !!}
				{!! Form::groupClose('email_confirm') !!}

				{!! Form::token() !!}
				<button type="submit" class="btn btn-primary">Update Email Address</button>
			</form>
		</div>
	</section>
@stop
