<!-- reply photo -->
<a href="{{ route('user/view', $status->author->id) }}" class="pull-left avatar thumb-xs">
	{!! $comment->author->present()->photoThumb('thumb-sm', ['width' => 40, 'height' => 40]) !!}
	{!! $comment->author->present()->onlineStatus !!}
</a>
<div class="block">
	<div class="status-reply">
		<div class="block">
			<a href="{{ route('user/view', $comment->author->id) }}" class="font-bold m-r-xs">
				{{ $comment->author->present()->name }}
			</a>
			{{ $comment->body }}
		</div>
		@include('statuses.partials.comment-interactions')
	</div>
</div>