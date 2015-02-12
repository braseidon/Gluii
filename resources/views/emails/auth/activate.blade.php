@extends('emails.template')

@section('body')
	<p>Welcome to {{ Config::get('gluii.appname') }}! To complete your registration, please follow the instructions below.</p>
	<p>Activate your account by clicking <a href="{{ route('auth/activate', [$user->getUserId(), $code]) }}">here</a></p>
@endsection