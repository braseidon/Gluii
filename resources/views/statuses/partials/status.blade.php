<li class="message">
	<div class="clear">
		<img class="online clear" src="{{ $status->author->present()->gravatar(50) }}" width="50" height="50"  alt="{{ $status->author->present()->name }}" />
		<small class="text-muted pull-right font-thin">
			{{ $status->created_at->diffForHumans() }}
		</small>
		<span class="message-text">
			<a class="username font-semibold" href="javascript:void(0);">
				{{ $status->author->present()->name }}
			</a>
			<p class="block">{{ $status->body }}</p>
		</span>
	</div>
	<ul class="list-inline text-xs m-t-sm block">
		<li><a class="btn btn-default btn-xs" href="javascript:void(0);"><i class="fa fa-reply"></i> Reply</a></li>
		<li><a class="btn btn-default btn-xs" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i> Like</a></li>
		<li><i class="fa fa-thumbs-o-up"></i> 0</li>
		<li><a class="btn btn-link btn-xs text-muted" href="javascript:void(0);">Show All Comments ({{ $status->present()->replyCount }})</a></li>
		<li class="pull-right">
			<a class="btn btn-link btn-xs text-muted" href="javascript:void(0);">Edit</a>
			<a class="btn btn-link btn-xs text-muted" href="javascript:void(0);">Delete</a>
		</li>
	</ul>
</li>

<!-- Status Replies -->
@if($status->has('comments'))
	@foreach($status->comments as $comment)
		@include('statuses.partials.reply')
	@endforeach
@endif