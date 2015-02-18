<ul class="list-inline m-t-sm m-b-none block">
	<!-- like -->
	<li>
		@if($status->isLikedBy(Auth::getUser()))
			<form action="{{ route('status/unlike') }}" method="POST">
				{!! Form::hidden('status_id', $status->id) !!}
				{!! Form::token() !!}
				<button type="submit" class="btn btn-link btn-sm">
					<i class="icon icon-dislike"></i> Unlike
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
	</li>
	<!-- comment -->
	<li>
		<a href="javascript:void(0);" class="btn btn-link btn-sm">
			<i class="icon icon-bubble"></i> Comment
		</a>
	</li>
	<!-- show comments -->
	<li>
		<a href="javascript:void(0);" class="btn btn-link btn-sm">
			Show All Comments ({{ $status->present()->replyCount }})
		</a>
	</li>
	<li>
		<a href="javascript:void(0);" class="btn btn-link btn-sm">
			ID#{{ $status->id }}
		</a>
	</li>
	@if(Auth::getUser()->id == $status->author->id)
		<li class="pull-right">
			<!-- edit -->
			<a href="javascript:void(0);" class="btn btn-link btn-sm text-muted">Edit</a>
			<!-- delete -->
			<!-- <a href="javascript:void(0);" class="btn btn-link btn-sm text-muted">Delete</a> -->
		</li>
	@endif
</ul>