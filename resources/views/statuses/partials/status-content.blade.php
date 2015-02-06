<div class="block m-b-sm clear">
	<!-- author photo -->
	<a href="{{ route('user/view', $status->author->id) }}" class="pull-left avatar thumb-sm">
		{!! $status->author->present()->photoThumb(50, ['class' => '']) !!}
		{!! $status->author->present()->onlineStatus !!}
	</a>
	<div class="m-l-xxl">
		<!-- author name -->
		<span class="block">
			<a href="{{ route('user/view', $status->author->id) }}" class="username font-semibold text-md">
				{{ $status->author->present()->name }}
			</a>
		</span>
		<!-- time posted -->
		<div class="block">
			<small class="text-muted font-thin" title="{{ $status->present()->timeFormatted }}">
				{{ $status->created_at->diffForHumans() }}
			</small>
		</div>
	</div>
</div>

<!-- status body -->
<div class="clear text-md">
	<p class="block">{{ $status->body }}</p>
</div>