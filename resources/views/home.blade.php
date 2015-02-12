@extends('template.master')

@section('title', 'Welcome to ' . Config::get('gluii.appname'))

@section('sidebar-left')
	asdasd
@endsection

@section('content')
	@include('statuses.view-timeline')
@endsection