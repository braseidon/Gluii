@extends('template.master')

@section('content-top')
	{{-- cover photo & profile picture --}}
	@include('profile.partials.cover')
@endsection

{{-- sidebar --}}
@section('sidebar-left')
	@include('profile.template.sidebar')
@overwrite