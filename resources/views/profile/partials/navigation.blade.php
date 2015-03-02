<ul class="nav nav-tabs navbar-right nav-content" role="menu">
	{!! HTML::liIconLink('user/view', 'Timeline', 'icon icon-user', $user->id) !!}
	{!! HTML::liIconLink('user/photos', 'Photos', 'icon icon-camera', $user->id) !!}
	{!! HTML::liIconLink('user/videos', 'Videos', 'icon icon-camcorder', $user->id) !!}
	{!! HTML::liIconLink('user/calendar', 'Calendar', 'icon icon-calendar', $user->id) !!}
</ul>