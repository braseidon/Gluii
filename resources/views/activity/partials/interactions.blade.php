<ul class="list-inline m-t-sm m-b-none block">
	{{-- Like / Unlike --}}
	@if(Auth::check())
		<li>
			@if($activity->isLikedBy(Auth::getUser()))
				<form action="{{ route('activity/unlike') }}" method="POST">
					{!! Form::hidden('activity_id', $activity->id) !!}
					{!! Form::token() !!}
					<button type="submit" class="btn btn-link btn-sm">
						<i class="icon icon-dislike"></i> Unlike
					</button>
				</form>
			@else
				<form action="{{ route('activity/like') }}" method="POST">
					{!! Form::hidden('activity_id', $activity->id) !!}
					{!! Form::token() !!}
					<button type="submit" class="btn btn-link btn-sm">
						<i class="icon icon-like"></i> Like
					</button>
				</form>
			@endif
		</li>
	@endif
	{{-- Comment --}}
	<li>
		<a href="javascript:void(0);" class="btn btn-link btn-sm">
			<i class="icon icon-bubble"></i> Comment
		</a>
	</li>
	{{-- Show Comments --}}
	<li>
		<a href="javascript:void(0);" class="btn btn-link btn-sm">
			Show All Comments ({{ $activity->present()->replyCount }})
		</a>
	</li>
	<li>
		<a href="javascript:void(0);" class="btn btn-link btn-sm">
			ID#{{ $activity->id }}
		</a>
	</li>
	{{-- Edit --}}
	@if(Auth::check() && $activity->user->id == Auth::getUser()->id)
		<li class="pull-right">
			<!-- edit -->
			<a href="javascript:void(0);" class="btn btn-link btn-sm text-muted">Edit</a>
			<!-- delete -->
			<!-- <a href="javascript:void(0);" class="btn btn-link btn-sm text-muted">Delete</a> -->
		</li>
	@endif
</ul>