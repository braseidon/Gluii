<div class="app-header-container container">
	<!-- navbar header -->
	<div class="navbar-header w-auto">
		<!-- mobile navigation -->
		<button class="pull-right visible-xs dk" ui-toggle="show" target=".navbar-collapse">
			<i class="glyphicon glyphicon-cog"></i>
		</button>
		<button class="pull-right visible-xs" ui-toggle="off-screen" target=".app-aside" ui-scroll="app">
			<i class="icon icon-music-tone-alt"></i>
		</button>

		<!-- brand -->
		<a href="{{ route('home') }}" class="navbar-brand text-lt m-r" title="{{ Config::get('gluii.appname') }}">
			<i class="icon icon-music-tone"></i>
			<img src="/assets/img/logo.png" alt="{{ Config::get('gluii.appname') }}" class="hide">
			<span class="hidden-folded m-l-xs">{{ Config::get('gluii.appname') }}</span>
		</a>
	</div>

	<!-- navbar collapse -->
	<div class="collapse pos-rlt navbar-collapse">
		<!-- top navigation -->
		@if(Auth::check())
			@include('template.header.nav-left')
		@endif

		<!-- search form -->
		@include('template.header.search')

		<!-- navbar right -->
		@if(Auth::check())
			@include('template.header.nav-right')
		@endif
	</div>
</div>