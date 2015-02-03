@extends('template.master')

@section('title')
	{!! $user->present()->name !!}
@endsection

@section('content-top')
	<!-- cover photo & profile picture -->
	@include('user.partials.cover')
@endsection

@section('content')
	<div class="row">
		<!-- sidebar -->
		<div class="col-md-4 hidden-xs hidden-sm m-t">
			@include('user.sidebar')
		</div>
		<!-- statuses -->
		<div class="col-md-8">
			<!-- timeline -->
			@include('statuses.view-timeline', ['statuses' => $user->statuses])
		</div>

	</div>
@endsection