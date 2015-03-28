<!-- user photo -->
@if($activity->user)
	<a href="{{ route('user/view', $activity->user->username) }}" class="pull-left avatar thumb-sm">
		{!! $activity->user->present()->photoThumb('thumb-sm', ['class' => 'img-round']) !!}
		{!! $activity->user->present()->onlineStatus !!}
	</a>
@endif
<div class="m-l-xxl">
	{{-- Activity Author --}}
	<span class="block text-md">
		@if(trim($__env->yieldContent('activity-title')))
			{!! trim($__env->yieldContent('activity-title')) !!}
		@endif
	</span>
	{{-- Time Posted --}}
	<div class="block">
		<a href class="text-muted" title="{{ $activity->present()->timeFormatted }}">
			<small><i class="icon icon-clock"></i> {{ $activity->created_at->diffForHumans() }}</small>
		</a>
	</div>
</div>