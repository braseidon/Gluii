@if(Auth::check())
	<ul class="nav navbar-nav navbar-right">
		{{-- friend requets --}}
		@include('template.header.dropdowns.friendrequests')
		{{-- messages --}}
		@include('template.header.dropdowns.messages')
		{{-- notifications --}}
		@include('template.header.dropdowns.notifications')
		{{-- admin menu --}}
		@if (Auth::check() && Auth::hasAccess('admin'))
			@include('template.admin-navigation')
		@endif
		{{-- user dropdown --}}
		@include('template.header.dropdowns.user-menu')
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