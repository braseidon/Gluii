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

	<link rel="stylesheet" href="assets/css/angular/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="assets/css/angular/animate.css" type="text/css" />
	<link rel="stylesheet" href="assets/css/angular/font-awesome.min.css" type="text/css" />
	<link rel="stylesheet" href="assets/css/angular/simple-line-icons.css" type="text/css" />
	<link rel="stylesheet" href="assets/css/angular/font.css" type="text/css" />
	<link rel="stylesheet" href="assets/css/angular/app.css" type="text/css" />

</head>
<body>

<div class="app app-header-fixed">
	<div class="container w-xxl w-auto-xs">
		<a class="navbar-brand block m-t" href="">Angulr</a>
		<div class="m-b-lg">
			@if()
			<div class="wrapper text-center">
				<strong></strong>
			</div>

			<!-- Content -->
			@yield('content')

		</div>
		<div class="text-center">
			<p>
				<small class="text-muted">Web app framework base on Bootstrap and AngularJS<br>
				&copy; 2014</small>
			</p>
		</div>
	</div>
</div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/ui-load.js"></script>
<script src="assets/js/ui-jp.config.js"></script>
<script src="assets/js/ui-jp.js"></script>
<script src="assets/js/ui-nav.js"></script>
<script src="assets/js/ui-toggle.js"></script>

</body>
</html>