{{-- New Status Form --}}
@include('statuses.forms.new-status')

@foreach($activities->items() as $activity)
	@include ("activity.types.{$activity->name}")
@endforeach
