@extends('template.master')

@section('title')
	{!! $user->present()->name !!}
@endsection

@section('content')
	<!-- cover photo & profile picture -->
	@include('user.partials.cover')

	<div class="row">
		<!-- sidebar -->
		<div class="col-lg-3">
			<!-- friends list -->
			@include('user.partials.friends')
		</div>
		<!-- statuses -->
		<div class="col-lg-9">
			<!-- timeline -->
			@include('statuses.view-timeline', ['statuses' => $user->statuses])
		</div>

	</div>
@endsection