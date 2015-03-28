<li class="dropdown">
	<a href class="dropdown-toggle clear user-dropdown" data-toggle="dropdown">
		<span class="thumb-xs avatar m-t-n-sm m-b-n-sm m-l-sm">
			{!! Auth::getUser()->present()->photoThumb('thumb-sm', ['width' => 40, 'height' => 40, 'class' => 'no-radius']) !!}
			<i class="on md b-white bottom"></i>
		</span>
		<b class="caret"></b>
	</a>
	<ul class="dropdown-menu w" role="menu">
		{{-- Main --}}
		<li><a href="{{ route('user/view', Auth::getUser()->username) }}">My Profile</a></li>
		<li><a href="{{ route('user/photos', Auth::getUser()->username) }}">My Photos</a></li>
		<li><a href="{{ route('user/videos', Auth::getUser()->username) }}">My Videos</a></li>
		<li><a href="{{ route('user/calendar', Auth::getUser()->username) }}">My Calendar</a></li>
		<li class="divider"></li>
		{{-- Account --}}
		<li><a href="#">Activity Log</a></li>
		<li><a href="{{ route('account/settings') }}">Settings</a></li>
		<li><a href="{{ route('account/security') }}">Security</a></li>
		<li><a href="#">Help</a></li>
		<li class="divider"></li>
		{{-- Logout --}}
		<li><a href="{{ route('auth/logout') }}">Logout</a></li>
	</ul>
</li>