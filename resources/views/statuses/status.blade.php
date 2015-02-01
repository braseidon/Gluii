<span class="timeline-seperator text-center">
	<span>{{ $status->present()->timeFormatted }}</span>
	<div class="btn-group pull-right">
		<a class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);">
			<span class="caret single"></span>
		</a>
		<ul class="dropdown-menu text-left animated flipInX">
			@if($status->user_id == $currentUser->id)
				<li><a href="javascript:void(0);">Delete post</a></li>
			@else
				<li><a href="javascript:void(0);">Hide this post</a></li>
				<li><a href="javascript:void(0);">Hide future posts from this user</a></li>
				<li><a href="javascript:void(0);">Mark as spam</a></li>
			@endif
		</ul>
	</div>
</span>

<div class="chat-body no-padding profile-message">
	<ul>
		@include('backend.statuses.partials.status')

		<!-- Reply Form -->
		@include('backend.statuses.forms.status-reply')
	</ul>
</div>