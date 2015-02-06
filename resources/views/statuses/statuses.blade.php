@if(isset($statuses) && ! $statuses->isEmpty())
	@foreach($statuses as $status)
		@include('statuses.status')
	@endforeach
@endif