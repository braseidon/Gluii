@extends('profile.template.profile')

@section('title', $user->present()->name)

@section('content')
	@parent

	{{-- timeline --}}
	@include('statuses.view-timeline')
@stop