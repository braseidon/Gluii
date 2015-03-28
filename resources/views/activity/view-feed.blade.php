{{-- New Status Form --}}
@include('statuses.forms.new-status')

@foreach($activities as $activity)
	@include("activity.types.{$activity->name}")
@endforeach
