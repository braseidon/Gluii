@extends('profile.template.profile')

@section('title', $user->present()->name)

@section('content')
	@parent

	{{-- Timeline --}}
	@include('statuses.view-timeline')
@stop