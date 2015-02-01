<!-- write on timeline -->
<h4 class="text-muted">
	@if(Auth::user()->id == $user->id)
		Update Status
	@else
		Write on {!! $user->first_name !!}'s Timeline
	@endif
</h4>
@include('statuses.forms.newstatus')

<!-- status updates -->
<h4 class="m-t text-muted">{!! $user->first_name !!}'s timeline</h4>
@if(isset($statuses))
	@foreach($statuses as $status)
		@include('statuses.status')
	@endforeach
@endif