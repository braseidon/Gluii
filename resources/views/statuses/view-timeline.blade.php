<!-- Create New Status -->
@include('backend.statuses.forms.new-status')

<!-- Status Updates List -->
@foreach($statuses as $status)
	@include('backend.statuses.status')
@endforeach