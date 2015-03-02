<div class="block m-b-sm clear">
	<!-- author photo -->
	<a href="{{ route('user/view', $status->author->id) }}" class="pull-left avatar thumb-sm">
		{!! $status->author->present()->photoThumb('thumb-sm', ['class' => '']) !!}
		{!! $status->author->present()->onlineStatus !!}
	</a>
	<div class="m-l-xxl">
		<!-- author name -->
		<span class="block">
			<a href="{{ route('user/view', $status->author->id) }}" class="username font-semibold text-md">
				{{ $status->author->present()->name }}
			</a>
			{{-- If Status author didn't post to his own wall --}}
			@if($status->author_id !== $status->profile_user_id)
				wrote on
				<a href="{{ route('user/view', $status->profileuser->id) }}" class="username font-semibold text-md">
					{{ $status->profileuser->present()->name }}'s
				</a> wall
			</a>
			@endif
		</span>
		<!-- time posted -->
		<div class="block">
			<a href class="text-muted" title="{{ $status->present()->timeFormatted }}">
				<small><i class="fa fa-fw fa-clock-o"></i> {{ $status->created_at->diffForHumans() }}</small>
			</a>
		</div>
	</div>
</div>

<!-- status body -->
<div class="clear text-md">
	<p class="block">{{ $status->body }}</p>
</div>