<!-- time posted -->
<span class="btn btn-link btn-sm text-muted">
	{{ $comment->created_at->diffForHumans() }}
</span>
<!-- like -->
@if($comment->isLikedBy(Auth::user()))
	<form class="inline" action="{{ route('status/comment/unlike') }}" method="POST">
		{!! Form::hidden('comment_id', $comment->id) !!}
		{!! Form::token() !!}
		<button type="submit" class="btn btn-link btn-sm">
			Unlike
		</button>
	</form>
@else
	<form class="inline" action="{{ route('status/comment/like') }}" method="POST">
		{!! Form::hidden('comment_id', $comment->id) !!}
		{!! Form::token() !!}
		<button type="submit" class="btn btn-link btn-sm">
			Like
		</button>
	</form>
@endif
<!-- like count -->
<button type="button" class="btn btn-link btn-sm">
	<i class="icon icon-like m-r-xs"></i> 0
</button>