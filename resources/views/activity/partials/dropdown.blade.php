<div class="btn-group pull-right">
	<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
		<span class="caret single"></span>
	</button>
	<ul class="dropdown-menu text-left animated flipInX">
		{{-- If activity is on User's wall, or User owns post --}}
		@if($activity->user->id == Auth::getUser()->id)
			<li><a href="javascript:void(0);">Edit post</a></li>
			<li><a href="javascript:void(0);">Hide from timeline</a></li>
			<li><a href="javascript:void(0);">Delete post</a></li>
		@else
			<li>
				<a href="javascript:void(0);">
					Hide this post
					{{-- Dev - Check ID's --}}
					@if (Auth::check() && Auth::hasAccess('admin'))
						<span class="text-muted">({{ $activity->user->id }} !== {{ Auth::getUser()->id }})</span>
					@endif
				</a>
			</li>
			<li><a href="javascript:void(0);">Hide future posts from this user</a></li>
			<li><a href="javascript:void(0);">Mark as spam</a></li>
		@endif
	</ul>
</div>