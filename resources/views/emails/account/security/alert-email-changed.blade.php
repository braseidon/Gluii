@extends('emails.template')

@section('body')
	<p>We're just letting you know that someone has just updated the login email address for your {{ Config::get('gluii.appname') }} account.</p>
	<p>If you didn't authorize this, then someone has probably gotten into your account. You can revert the change by <a href="#">clicking this link</a>. It is highly recommended that you change your password if you didn't make this change.</p>
@endsection