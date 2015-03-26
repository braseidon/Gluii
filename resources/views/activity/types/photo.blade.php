@extends('activity.activity')

@section('activity-title')
	{{ $activity->user->present()->name }} uploaded a new photo {{ $activity->created_at->diffForHumans() }}.
@overwrite

@section('activity-content')
	<div class="row">
		<div class="col-lg-12 text-center">
			{!! $activity->subject->present()->thumbLink('medium') !!}
		</div>
	</div>
@overwrite