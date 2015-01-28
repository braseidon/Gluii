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
	<!-- / assets - header -->

</head>
<body>
	<div class="app app-header-fixed">

		<!-- header -->
		@include('template.header')
		<!-- / header -->

		<!-- aside -->
		<aside class="app-aside hidden-xs bg-dark" id="aside">
			<div class="aside-wrap">
				<div class="navi-wrap">
					<!-- user -->
					{{--@include('template.partials.navigation-user-menu')--}}
					<!-- / user -->

					<!-- nav -->
					@include('template.navigation')
					<!-- nav -->

					<!-- aside footer -->
					{{--@include('template.partials.navigation-footer')--}}
					<!-- / aside footer -->
				</div>
			</div>
		</aside>
		<!-- / aside -->

		<!-- content -->
		<div class="app-content" id="content" role="main">
			<div class="app-content-body app-content-full">
				<!-- hbox layout -->
				<div class="hbox hbox-auto-xs hbox-auto-sm">
					<!-- column -->
					{{--@include('template.partials.sidebar-right')--}}
					<!-- /column -->

					<!-- column -->
					@include('template.partials.content')
					<!-- /column -->

					<!-- column -->
					@include('template.partials.sidebar-right')
					<!-- /column -->
				</div>
				<!-- /hbox layout -->
			</div>
		</div>
		<!-- / content -->

		<!-- footer -->
		@include('template.footer')
		<!-- / footer -->
	</div>

	<!-- assets - footer -->
	@include('template.assets.footer')
	<!-- / assets - footer -->

	</body>
</html>