@extends('emails.template')

@section('body')
	Activate your account by clicking <a href="{{ URL::to("activate/{$user->getUserId()}/{$code}") }}">here</a>
@endsection