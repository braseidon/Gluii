<li class="list-group-item no-padder clearfix">
	<!-- reply photo -->
	<span class="pull-left avatar thumb-xs">
		{!! $comment->author->present()->photoThumb(40, ['class' => 'no-radius']) !!}
		{!! $comment->author->present()->onlineStatus !!}
	</span>
	<div class="block">
		<div class="status-reply">
			<div class="block">
				<a href="{{ route('user/view', $comment->author->id) }}" class="font-bold m-r-xs">{{ $comment->author->present()->name }}</a>
				{{ $comment->body }}
			</div>
			@include('statuses.partials.comment-interactions')
		</div>
	</div>
</li>