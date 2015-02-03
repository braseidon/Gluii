<li class="message message-reply">
	<div class="clear">
		<img class="online clear" src="{{ $comment->author->present()->getGravatar(50) }}" width="50" height="50" alt="{{ $comment->author->username }}" />
		<small class="text-muted pull-right font-thin">
			{{ $comment->created_at->diffForHumans() }}
		</small>
		<span class="message-text">
			<a class="username font-semibold" href="javascript:void(0);">
				{{ $comment->author->username }}
			</a>
			<p class="block">{{ $comment->body }}</p>
		</span>
	</div>
	<ul class="list-inline text-xs block">
		<li><a class="btn btn-default btn-xs" href="javascript:void(0);"><i class="fa fa-thumbs-o-up"></i> Like</a></li>
		<li><i class="fa fa-thumbs-o-up"></i> 0</li>
	</ul>
</li>