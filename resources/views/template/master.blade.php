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

</head>
<body class="app-header-fixed">
	<!-- header -->
	@include('template.header')

		<!-- aside - left -->
		@include('template.aside-left')

	<div class="app app-header-fixed container no-shadow">

			<!-- content -->
				<div id="content" class="app-content-body app-content-full" role="main">
					<!-- hbox layout -->
					<div class="hbox hbox-auto-xs hbox-auto-sm">
						<!-- content sidebar - left -->
						@if(! empty(trim($__env->yieldContent('sidebar-left'))))
							@include('template.partials.sidebar-left')
						@endif

						<!-- main content -->
						@include('template.partials.content')

						<!-- content sidebar - right -->
						@if(! empty(trim($__env->yieldContent('sidebar-right'))))
							@include('template.partials.sidebar-right')
						@endif
					</div>
				</div>

		<!-- aside - right -->
		{{--@include('template.aside-right')--}}

	</div>
		<!-- footer -->
		@include('template.footer')

	<!-- assets - footer -->
	@include('template.assets.footer')

	</body>
</html>