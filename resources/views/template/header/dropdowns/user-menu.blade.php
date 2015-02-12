<li class="dropdown">
	<a href class="dropdown-toggle clear" data-toggle="dropdown">
		<span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
			<img src="{{ Auth::getUser()->present()->gravatar(40) }}" width="40" height="40" alt="...">
			<i class="on md b-white bottom"></i>
		</span>
		<span class="hidden-sm hidden-md">{{ Auth::getUser()->present()->name }}</span> <b class="caret"></b>
	</a>
	<ul class="dropdown-menu w" role="menu">
		<li class="wrapper b-b m-b-sm bg-light m-t-n-xs">
			<div><p>300mb of 500mb used</p></div>
			<div class="progress progress-xs m-b-none dker">
				<div class="progress-bar progress-bar-info" data-toggle="tooltip" data-original-title="50%" style="width: 50%"></div>
			</div>
		</li>
		<li><a href="{{ route('user/view', Auth::getUser()->id) }}">My Profile</a></li>
		<li><a href="#">Settings</a></li>
		<li><a href="#">Help</a></li>
		<li class="divider"></li>
		<li><a href="{{ route('auth/logout') }}">Logout</a></li>
	</ul>
</li>