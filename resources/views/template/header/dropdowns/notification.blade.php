<div class="media list-group-item{{ ! $notification->is_read ? ' unread' : '' }}">
	<span class="pull-left thumb">
		{!! $notification->present()->image() !!}
	</span>
	<span class="media-body m-b-none">
		<!-- user's name -->
		<a href="{{ $notification->present()->url }}">
			{{ $notification->present()->message }}
		</a>
		<small class="block text-muted" title="{{ $notification->present()->timeFormatted() }}">
			{!! $notification->present()->icon !!} {{ $notification->created_at->diffForHumans() }}
		</small>
	</span>
</div>