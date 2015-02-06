<!-- time posted -->
<span class="btn btn-link btn-sm text-muted">
	{{ $comment->created_at->diffForHumans() }}
</span>
<!-- like -->
@if($comment->isLikedBy(Auth::user()))
	<form class="inline" action="{{ route('status/comment/unlike') }}" method="POST">
		{!! Form::hidden('comment_id', $comment->id) !!}
		{!! Form::token() !!}
		<button type="submit" class="btn btn-link btn-sm text-base">
			Unlike
		</button>
	</form>
@else
	<form class="inline" action="{{ route('status/comment/like') }}" method="POST">
		{!! Form::hidden('comment_id', $comment->id) !!}
		{!! Form::token() !!}
		<button type="submit" class="btn btn-link btn-sm text-base">
			Like
		</button>
	</form>
@endif
<!-- like count -->
@if(! $comment->likes->isEmpty())
	<button type="button" class="btn btn-link btn-sm text-base" {{--{!! tooltip($comment->likes->first()->present()->name . ' likes this', 'right') !!}--}}>
		<i class="icon icon-like m-r-xs"></i> {{ $comment->likes->count() }}
	</button>
@endif