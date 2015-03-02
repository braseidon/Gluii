<li class="dropdown">
	<a href class="dropdown-toggle clear" data-toggle="dropdown">
		<span class="thumb-sm avatar m-t-n-sm m-b-n-sm m-l-sm">
			<img src="{{ Auth::getUser()->present()->gravatar(40) }}" width="40" height="40" alt="...">
			<i class="on md b-white bottom"></i>
		</span>
		<b class="caret"></b>
	</a>
	<ul class="dropdown-menu w" role="menu">
		{{-- Main --}}
		<li><a href="{{ route('user/view', Auth::getUser()->id) }}">My Profile</a></li>
		<li><a href="{{ route('user/view', Auth::getUser()->id) }}">My Photos</a></li>
		<li><a href="{{ route('user/view', Auth::getUser()->id) }}">My Videos</a></li>
		<li class="divider"></li>
		{{-- Account --}}
		<li><a href="#">Settings</a></li>
		<li><a href="#">Security</a></li>
		<li><a href="#">Help</a></li>
		<li class="divider"></li>
		{{-- Logout --}}
		<li><a href="{{ route('auth/logout') }}">Logout</a></li>
	</ul>
</li>