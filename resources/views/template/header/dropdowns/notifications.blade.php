<li class="dropdown" data-toggle="ajax-dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		<i class="icon icon-bell fa-fw"></i>
		<span class="visible-xs-inline">Notifications</span>
		@if(Auth::getUser()->getNotifications()->count() > 0)
			<span class="badge badge-sm up bg-danger pull-right-xs">
				{{ Auth::getUser()->getNotifications()->count() }}
			</span>
		@endif
	</a>
	<div class="dropdown-menu w-xxl" role="menu">
		<div class="panel bg-white dropdown-persist">
			<div class="panel-heading b-light bg-light">
				<strong>You have <span>{{ Auth::getUser()->getNotifications()->count() }}</span> {{ str_plural('notification', Auth::getUser()->getNotifications()->count()) }}</strong>
			</div>
			<div class="list-group ajax-content" data-ajax-url="{{ route('notifications/notifications') }}">
				<!-- notifications -->
			</div>
			<div class="panel-footer text-sm">
				<button class="btn btn-default btn-xs pull-right refresh-button" {!! tooltip('Refresh') !!}><i class="icon icon-refresh"></i></button>
				<a href="#notes" data-toggle="class:show animated fadeInRight">See all the notifications</a>
			</div>
		</div>
	</div>
</li>