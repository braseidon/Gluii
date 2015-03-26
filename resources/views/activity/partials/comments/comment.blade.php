<!-- reply photo -->
<a href="{{ route('user/view', $comment->author->username) }}" class="pull-left avatar thumb-xs">
	{!! $comment->author->present()->photoThumb('thumb-sm', ['width' => 40, 'height' => 40, 'class' => 'no-radius']) !!}
	{!! $comment->author->present()->onlineStatus !!}
</a>
<div class="block">
	<div class="activity-reply">
		<div class="block">
			<a href="{{ route('user/view', $comment->author->username) }}" class="font-bold m-r-xs">
				{{ $comment->author->present()->name }}
			</a>
			{{ $comment->body }}
		</div>
		@include('activity.partials.comments.interactions')
	</div>
</div>