<li class="dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		<i class="icon icon-users fa-fw"></i>
		<span class="visible-xs-inline">Friend Requests</span>
		@if(Auth::getUser()->getRequestsPending()->count() > 0)
			<span class="badge badge-sm up bg-danger pull-right-xs">
				{{ Auth::getUser()->getRequestsPending()->count() }}
			</span>
		@endif
	</a>
	<div class="dropdown-menu w-xl animated flipInX">
		<div class="panel bg-white">
			<div class="panel-heading b-light bg-light">
				<strong>You have <span>{{ Auth::getUser()->getRequestsPending()->count() }}</span> friend {{ str_plural('request', Auth::getUser()->getRequestsPending()->count()) }}</strong>
			</div>
			<div class="list-group">
				@foreach(Auth::getUser()->getRequestsPending() as $pendingFriend)
					<div class="media list-group-item">
						<span class="pull-left thumb-sm">
							{!! $pendingFriend->present()->photoThumb(60) !!}
						</span>
						<span class="media-body block m-b-none">

								<a href="{{ route('user/view', $pendingFriend->id) }}">
									{{ $pendingFriend->present()->name }}
								</a>
								<div class="pull-right">
									<a href="{{ route('user/request/accept', ['fromId' => $pendingFriend->id]) }}" class="btn btn-default btn-xs" {!! tooltip('Accept') !!}><i class="fa fa-check text-success"></i></a>
									<a href="{{ route('user/request/deny', ['fromId' => $pendingFriend->id]) }}" class="btn btn-default btn-xs m-l-xs" {!! tooltip('Deny') !!}><i class="fa fa-times text-danger"></i></a>
								</div>

							<small class="block text-muted">{{ $pendingFriend->pivot->created_at->diffForHumans() }}</small>
						</span>
					</div>
				@endforeach
			</div>
			<div class="panel-footer text-sm">
				<a href class="pull-right"><i class="fa fa-cog"></i></a>
				<a href="#notes" data-toggle="class:show animated fadeInRight">See all friend requests</a>
			</div>
		</div>
	</div>
</li>