<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<!-- ~Bomb Diggity
	 ____  _           _   _       ____    _____           _
	/ ___|| |__  _   _| |_| |_ ___|  _ \  |_   _|__   ___ | |___
	\___ \| '_ \| | | | __| __/ _ \ |_) |   | |/ _ \ / _ \| / __|
	 ___) | | | | |_| | |_| ||  __/  _ <    | | (_) | (_) | \__ \
	|____/|_| |_|\__,_|\__|\__\___|_| \_\   |_|\___/ \___/|_|___/
	-->
	<title>{{ trim($__env->yieldContent('title')) }} | {{ Config::get('gluii.appname') }}</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<!-- assets - header -->
	@include('template.assets.header')

	<link rel="icon" type="image/png" href="/images/favicon.png" />
	<link rel="shortcut icon" href="/images/favicon.png">

</head>
<body>
	<div class="app app-header-fixed app-aside-fixed bg-light">

		<!-- header -->
		<header id="header" class="app-header navbar bg-primary" role="menu">
			@include('template.header')
		</header>

		<!-- aside - left -->
		@if (Auth::check() && Auth::hasAccess('admin'))
			<aside id="aside-left" class="app-aside app-aside-left hidden-xs bg-dark">
				@include('template.aside-left')
			</aside>
		@endif

		<!-- aside - right -->
		@if (Auth::check() && Auth::hasAccess('admin') && 1 == 2)
			<aside id="aside-right" class="app-aside app-aside-right hidden-xs bg-dark">
				@include('template.aside-right')
			</aside>
		@endif

		<!-- content -->
		<div id="content" class="app-content" role="main">
			<div class="app-content-body app-content-full">
				<!-- hbox layout -->
				<div class="hbox hbox-auto-xs">
					<div class="vbox">
						{{-- Page Title --}}
						@if(Route::is('admin/*'))
							@include('template.partials.title')
						@endif

						{{-- Full-Width Content --}}
						@yield('content_full')

						<div class="container">
							<!-- top content -->
							@yield('content-top')
							<!-- flash messages -->
							@include('template.partials.flash-messages')
							<!-- main content -->
							<div class="m-t">
								@include('template.partials.content')
							</div>
						</div>

					</div><!-- /.vbox -->
				</div><!-- /.hbox -->
			</div>
		</div>

		<!-- footer -->
		@include('template.footer')
	</div>

	<!-- assets - footer -->
	@include('template.assets.footer')

	</body>
</html>