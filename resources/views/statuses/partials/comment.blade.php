<li class="list-group-item no-padder clearfix">
	<!-- reply photo -->
	<span class="pull-left avatar thumb-xs pos-rlt">
		{!! $comment->author->present()->photoThumb(40, ['class' => 'no-radius']) !!}
		{!! $comment->author->present()->onlineStatus !!}
	</span>
	<div class="block pos-rlt">
		<div class="status-reply">
			<div class="block">
				<a href="" class="font-bold m-r-xs">{{ $comment->author->present()->name }}</a>
				{{ $comment->body }}
			</div>
			@include('statuses.partials.comment-interactions')
		</div>
	</div>
</li>