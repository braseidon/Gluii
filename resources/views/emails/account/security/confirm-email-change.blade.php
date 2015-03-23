@extends('emails.template')

@section('body')
	<p>In order for this to be your new login email, you must confirm this email address by <a href="{{ route('account/security/update-email/confirm', $code) }}">clicking this link</a>.</p>
	<p>If you can't click the link, you can copy this link and paste it into your browser:</p>
	<p>{{ route('account/security/update-email/confirm', $code) }}</p>
@endsection