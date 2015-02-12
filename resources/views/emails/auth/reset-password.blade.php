@extends('emails.template')

@section('body')
	<p>Your or someone else has requested to reset the password for your account. If this wasn't you, please let us know and disregard this email.</p>

	<p>Click here to reset your password: {{ route('auth/reset-password', [$user->id, $code]) }}</p>
@endsection