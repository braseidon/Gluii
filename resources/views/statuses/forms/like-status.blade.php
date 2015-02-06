@if($status->isLikedBy(Auth::user()))
	<form action="{{ route('status/unlike') }}" method="POST">
		{!! Form::hidden('status_id', $status->id) !!}
		{!! Form::token() !!}
		<button type="submit" class="btn btn-link btn-sm">
			<i class="icon icon-like"></i> Unlike
		</button>
	</form>
@else
	<form action="{{ route('status/like') }}" method="POST">
		{!! Form::hidden('status_id', $status->id) !!}
		{!! Form::token() !!}
		<button type="submit" class="btn btn-link btn-sm">
			<i class="icon icon-like"></i> Like
		</button>
	</form>
@endif