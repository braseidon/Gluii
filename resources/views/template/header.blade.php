<header class="app-header navbar" id="header" role="menu">
	<!-- navbar header -->
	<div class="navbar-header bg-dark">
		<button class="pull-right visible-xs dk" ui-toggle="show" target=".navbar-collapse">
			<i class="glyphicon glyphicon-cog"></i>
		</button>
		<button class="pull-right visible-xs" ui-toggle="off-screen" target=".app-aside" ui-scroll="app">
			<i class="glyphicon glyphicon-align-justify"></i>
		</button>

		<!-- brand -->
		<a href="#" class="navbar-brand text-lt">
			<i class="icon icon-music-tone"></i>
			<img src="/assets/img/logo.png" alt="." class="hide">
			<span class="hidden-folded m-l-xs">{{ Config::get('gluii.appname') }}</span>
		</a>
		<!-- / brand -->
	</div>
	<!-- / navbar header -->

	<!-- navbar collapse -->
	<div class="collapse pos-rlt navbar-collapse box-shadow bg-white-only">
		<!-- left buttons -->
		<div class="nav navbar-nav hidden-xs">
			<a href="#" class="btn no-shadow navbar-btn" ui-toggle="app-aside-folded" target=".app">
				<i class="fa fa-dedent fa-fw text"></i>
				<i class="fa fa-indent fa-fw text-active"></i>
			</a>
			<a href="{{ route('home') }}" class="btn no-shadow navbar-btn">
				Home
			</a>
		</div>
		<!-- / left buttons -->

		<!-- search form -->
		@include('template.header.search')
		<!-- / search form -->

		<!-- nabar right -->
		@include('template.header.nav-right')
		<!-- / navbar right -->
	</div>
	<!-- / navbar collapse -->
</header>