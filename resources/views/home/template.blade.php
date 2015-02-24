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
		<title>{{ Config::get('gluii.appname') }}</title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

		<!-- assets - header -->
		@include('template.assets.header')
		<link type="text/css" rel="stylesheet" href="/assets/css/lander.css" />

		<link rel="icon" type="image/png" href="/images/favicon.png" />
		<link rel="shortcut icon" href="/images/favicon.png">

	</head>
	<body>
		<div class="app app-lander app-header-fixed bg-light">

			<!-- header -->
			<header id="header" class="app-header app-header-lander" role="menu">
				<section class="intro">
					<div class="intro-body">
						<div class="container">
							@yield('lander')
						</div>
					</div>
				</section>
			</header>

			<!-- content -->
			<div id="content" class="app-content" role="main">
				<div class="app-content-body app-content-full">
					<!-- hbox layout -->
					<div class="hbox hbox-auto-xs">
						<div class="vbox">

							@yield('content')

						</div><!-- /.vbox -->
					</div><!-- /.hbox -->
				</div>
			</div>

			<!-- footer -->
			{{-- @include('template.footer') --}}
		</div>

		<!-- assets - footer -->
		@include('template.assets.footer')

	</body>
</html>