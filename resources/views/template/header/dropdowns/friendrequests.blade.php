<li class="dropdown" data-toggle="ajax-dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		<i class="icon icon-users fa-fw"></i>
		<span class="visible-xs-inline">Friend Requests</span>
		@if(Auth::getUser()->getRequestsPending()->count() > 0)
			<span class="badge badge-sm up bg-danger pull-right-xs">
				{{ Auth::getUser()->getRequestsPending()->count() }}
			</span>
		@endif
	</a>
	<div class="dropdown-menu w-xxl" role="menu">
		<div class="panel bg-white dropdown-persist">
			<div class="panel-heading b-light bg-light">
				<strong>You have <span>{{ Auth::getUser()->getRequestsPending()->count() }}</span> friend {{ str_plural('request', Auth::getUser()->getRequestsPending()->count()) }}</strong>
			</div>
			<div class="list-group ajax-content" data-ajax-url="{{ route('notifications/friend-requests') }}">
				<!-- friend requests -->
			</div>
			<div class="panel-footer text-sm">
				<button class="btn btn-default btn-xs pull-right refresh-button" {!! tooltip('Refresh') !!}><i class="icon icon-refresh"></i></button>
				<a href="#notes" data-toggle="class:show animated fadeInRight">See all friend requests</a>
			</div>
		</div>
	</div>
</li>