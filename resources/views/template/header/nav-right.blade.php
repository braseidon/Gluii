@if(Auth::check())
	<ul class="nav navbar-nav navbar-right">
		<!-- friend requets -->
		@include('template.header.friendrequests')
		<!-- messages -->
		@include('template.header.messages')
		<!-- notifications -->
		@include('template.header.notifications')
		<!-- user dropdown -->
		@include('template.header.user-menu')
	</ul>
@else
	<!-- login form -->
	{{--@include('template.header.nav-right-login')--}}
	<!-- / login form -->

	<!-- sign in link -->
	<ul class="nav navbar-nav navbar-right hidden-xs">
		{!! HTML::liLinkRoute('auth/login', 'Sign In', [], ['class' => '']) !!}
		{!! HTML::liLinkRoute('auth/register', 'Create Account', [], ['class' => '']) !!}
	</ul>
	<!-- / sign in link -->
@endif