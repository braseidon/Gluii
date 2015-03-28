@extends('activity.activity')

@section('activity-title')
	{!! $activity->user->present()->nameLink !!}
	uploaded a new photo.
@overwrite

@section('activity-content')
	<div class="row">
		<div class="col-lg-12 text-center">
			{!! $activity->subject->present()->thumbLink('medium') !!}
		</div>
	</div>
@overwrite