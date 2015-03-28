<ul class="list-inline m-b-none block">
	{{-- Like / Unlike --}}
	@if(Auth::check())
		<li>
			@if($activity->liked())
				<form action="{{ route('activity/unlike', $activityType) }}" method="POST">
					{!! Form::hidden('activity_id', $activity->id) !!}
					{!! Form::token() !!}
					<button type="submit" class="btn btn-default btn-sm active">
						<i class="icon icon-dislike"></i> Unlike
					</button>
				</form>
			@else
				<form action="{{ route('activity/like', $activityType) }}" method="POST">
					{!! Form::hidden('activity_id', $activity->id) !!}
					{!! Form::token() !!}
					<button type="submit" class="btn btn-default btn-sm">
						<i class="icon icon-like"></i> Like
					</button>
				</form>
			@endif
		</li>
	@endif
	{{-- Comment --}}
	<li>
		<a href="javascript:void(0);" class="btn btn-default btn-sm">
			<i class="icon icon-bubble"></i> Comment
		</a>
	</li>
	{{-- Show Comments --}}
	<li>
		<a href="javascript:void(0);" class="btn btn-link btn-sm">
			Show All Comments ({{ $activity->comments->count() }})
		</a>
	</li>
	<li>
		<a href="javascript:void(0);" class="btn btn-link btn-sm text-muted">
			ID#{{ $activity->id }}
		</a>
	</li>
	{{-- Activity Type --}}
	@if(Auth::check() && Auth::hasAccess('admin'))
		<li>
			<a href="javascript:void(0);" class="btn btn-link btn-sm text-muted">
				{{ $activity->getMorphClass() }}
			</a>
		</li>
	@endif
	{{-- Edit --}}
	@if(Auth::check() && $activity->user->id == Auth::getUser()->id)
		<li class="pull-right">
			{{-- Edit --}}
			<a href="javascript:void(0);" class="btn btn-link btn-sm text-muted">Edit</a>
			{{-- Delete --}}
			<a href="javascript:void(0);" class="btn btn-link btn-sm text-muted">Delete</a>
		</li>
	@endif
</ul>