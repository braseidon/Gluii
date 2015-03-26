@extends('activity.activity')

@section('activity-title')
	<a href="{{ route('user/view', $activity->subject->author->username) }}" class="username font-semibold text-md">
		{{ $activity->subject->author->present()->name }}
	</a>
	{{-- If Status author didn't post to his own wall --}}
	@if($activity->subject->author_id !== $activity->subject->profile_user_id)
		wrote on
		<a href="{{ route('user/view', $activity->subject->profileuser->username) }}" class="username font-semibold text-md">
			{{ $activity->subject->profileuser->present()->name }}'s
		</a> wall
	</a>
	@endif
@overwrite

@section('activity-content')
	<p class="block">{{ $activity->subject->body }}</p>
@overwrite