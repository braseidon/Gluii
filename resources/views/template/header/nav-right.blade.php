@if(Auth::check())
	<ul class="nav navbar-nav navbar-right">
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
	<div class="nav navbar-nav navbar-right hidden-xs">
		<a href="{{ route('auth/login') }}" class="btn btn-default navbar-btn">
			Sign in
		</a>
	</div>
	<!-- / sign in link -->
@endif