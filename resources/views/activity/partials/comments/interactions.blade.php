{{-- time posted --}}
<span class="btn btn-link btn-xs text-muted no-padder" title="{{ $comment->present()->timeFormatted }}">
	<i class="fa fa-fw fa-clock-o"></i> {{ $comment->created_at->diffForHumans() }}
</span>
{{-- like --}}
@if(Auth::check())
	@if($comment->isLikedBy(Auth::getUser()))
		<form class="inline" action="{{ route('status/comment/unlike') }}" method="POST">
			{!! Form::hidden('comment_id', $comment->id) !!}
			{!! Form::token() !!}
			<button type="submit" class="btn btn-link btn-xs text-primary no-padder m-l-sm">
				Unlike
			</button>
		</form>
	@else
		<form class="inline" action="{{ route('status/comment/like') }}" method="POST">
			{!! Form::hidden('comment_id', $comment->id) !!}
			{!! Form::token() !!}
			<button type="submit" class="btn btn-link btn-xs text-primary no-padder m-l-sm">
				Like
			</button>
		</form>
	@endif
@endif
{{-- like count --}}
@if(! $comment->likes->isEmpty())
	<button type="button" class="btn btn-link btn-xs text-primary no-padder m-l-sm">
		<i class="icon icon-like"></i> {{ $comment->likes->count() }}
	</button>
@endif