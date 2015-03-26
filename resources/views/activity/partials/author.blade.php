<div class="block m-b-sm clear">
	<!-- user photo -->
	<a href="{{ route('user/view', $activity->user->username) }}" class="pull-left avatar thumb-sm">
		{!! $activity->user->present()->photoThumb('thumb-sm', ['class' => 'img-round']) !!}
		{!! $activity->user->present()->onlineStatus !!}
	</a>
	<div class="m-l-xxl">
		{{-- Activity Author --}}
		<span class="block">
			@yield('activity-title')
		</span>
		{{-- Time Posted --}}
		<div class="block">
			<a href class="text-muted" title="{{ $activity->present()->timeFormatted }}">
				<small><i class="fa fa-fw fa-clock-o"></i> {{ $activity->created_at->diffForHumans() }}</small>
			</a>
		</div>
	</div>
</div>