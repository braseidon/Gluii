@extends('template.master')

@section('title', 'View Status')

@section('sidebar-left')
	@include('template.sidebars.default')
@endsection

@section('content')
	@include('statuses.status')
@stop