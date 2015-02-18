@extends('template.master')

@section('title', 'News Feed')

@section('sidebar-left')
	@include('template.sidebars.default')
@endsection

@section('content')
	@include('feeds.partials.feedswitcher')

	@include('statuses.view-timeline')
@endsection