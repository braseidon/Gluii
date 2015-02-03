<section class="panel panel-default m-b">
	<header class="panel-heading">
		<a href="#" class="font-bold text-black">Friends</a>
		({{ number_format($user->getFriendsByStatus(true)->get()) }})
	</header>
	<div class="panel-body no-padder">
		<div class="row userprofile-sidebar-list no-gutter">
			@if(! $user->friends->isEmpty())
				@foreach($user->friends->take(12) as $friend)
					<div class="col-md-4 col-lg-3">
						<a href="{{ route('user/view', $friend->id) }}">
							{!! $friend->present()->photoThumb(120, ['class' => 'userprofile-sidebar-list-item']) !!}
							<div>
								<span class="text-sm">{!! $friend->present()->name !!}</span>
							</div>
						</a>
					</div>
				@endforeach
			@endif
		</div>
	</div>
</section>