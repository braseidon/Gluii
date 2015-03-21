@extends('template.master')

{{-- top area --}}
@section('content-top')
	{{-- cover photo & profile picture --}}
	@include('profile.partials.cover')
@endsection

{{-- sidebar --}}
@section('sidebar-left')
	@include('profile.template.sidebar')
@overwrite

{{-- content area --}}
@section('content')
	{{-- Profile Navigation --}}
	@include('profile.partials.navigation')
@endsection