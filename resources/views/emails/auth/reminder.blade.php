@extends('emails.template')

@section('body')
	Reset your password by clicking <a href="{{ URL::to("reset/{$user->getUserId()}/{$code}") }}">here</a>
@endsection