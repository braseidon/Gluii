@extends('emails.template')

@section('body')
	Click here to reset your password: {{ route('auth/reset-password', $token) }}
@endsection