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
<body>

	<div class="app app-header-fixed app-aside-fixed">

		<!-- header -->
		<header id="header" class="app-header navbar bg-primary" role="menu">
			@include('template.header')
		</header>

		<!-- aside - left -->
		{{--@include('template.aside-left')--}}

		<!-- aside - right -->
		{{--@include('template.aside-right')--}}

		<!-- content -->
		<div class="app-content">
			<div id="content" class="app-content-body fade-in-up" role="main">
				<!-- hbox layout -->
				<div class="hbox hbox-auto-xs hbox-auto-sm">

					<!-- page title -->
					{{--@if(! empty(trim($__env->yieldContent('title'))))
						<div class="bg-light lter b-b wrapper-md ng-scope">
							<div class="container">
								<h1 class="m-n font-thin h3">{{ trim($__env->yieldContent('title')) }}</h1>
							</div>
						</div>
					@endif--}}

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


				</div>
			</div>
		</div>

		<!-- footer -->
		@include('template.footer')
	</div>

	<!-- assets - footer -->
	@include('template.assets.footer')

	</body>
</html>