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
			<!-- write on timeline -->
			@include('statuses.forms.newstatus')

			<!-- timeline -->
			<h4 class="text-muted">{!! $user->first_name !!}'s timeline</h4>
		</div>

	</div>
@endsection