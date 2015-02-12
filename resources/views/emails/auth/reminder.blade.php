@extends('emails.template')

@section('body')
	<p>Reset your password by clicking <a href="{{ URL::to("reset/{$user->getUserId()}/{$code}") }}">here</a></p>
@endsection