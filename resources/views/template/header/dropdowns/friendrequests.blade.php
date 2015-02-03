<li class="dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		<i class="icon icon-users fa-fw"></i>
		<span class="visible-xs-inline">Friend Requests</span>
		<span class="badge badge-sm up bg-danger pull-right-xs">
			{{ Auth::user()->requestsPending()->count() }}
		</span>
	</a>
	<div class="dropdown-menu w-xl animated flipInX">
		<div class="panel bg-white">
			<div class="panel-heading b-light bg-light">
				<strong>You have <span>2</span> friend requests</strong>
			</div>
			<div class="list-group">
				@foreach(Auth::user()->requestsPending() as $pendingFriend)
					<div class="media list-group-item">
						<span class="pull-left thumb-sm">
							{!! $pendingFriend->present()->photoThumb(60) !!}
						</span>
						<span class="media-body block m-b-none">
							<div class="block">
								<a href="{{ route('user/view', $pendingFriend->id) }}">
									{{ $pendingFriend->present()->name }}
								</a>
								<div class="pull-right">
									<a href="{{ route('user/request/accept', ['fromId' => $pendingFriend->id]) }}" class="btn btn-default btn-xs" {!! tooltip('Accept') !!}><i class="fa fa-check text-success"></i></a>
									<a href="{{ route('user/request/deny', ['fromId' => $pendingFriend->id]) }}" class="btn btn-default btn-xs m-l-xs" {!! tooltip('Deny') !!}><i class="fa fa-times text-danger"></i></a>
								</div>
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