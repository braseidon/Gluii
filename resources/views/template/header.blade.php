<header class="app-header navbar" id="header">
	<!-- navbar header -->
	<div class="navbar-header bg-dark">
		<button class="pull-right visible-xs dk glyphicon glyphicon-cog"></button> <button class="pull-right visible-xs glyphicon glyphicon-align-justify"></button> <!-- brand -->
		 <a class="navbar-brand text-lt" href="#/"><i class="fa fa-btc"></i> <img alt="." class="hide" src="img/logo.png"> <span class="hidden-folded m-l-xs">Angulr</span></a> <!-- / brand -->
	</div>
	<!-- / navbar header -->

	<!-- navbar collapse -->
	<div class="collapse pos-rlt navbar-collapse box-shadow bg-white-only">
		<!-- buttons -->
		<div class="nav navbar-nav hidden-xs">
			<a class="btn no-shadow navbar-btn" href="#" target=".app"><i class="fa fa-dedent fa-fw text"></i> <i class="fa fa-indent fa-fw text-active"></i></a> <a class="btn no-shadow navbar-btn icon-user fa-fw" href="#" target="#aside-user"></a>
		</div>
		<!-- / buttons -->

		<!-- link and dropdown -->
		<ul class="nav navbar-nav hidden-sm">
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="fa fa-fw fa-plus visible-xs-inline-block"></i>
					<span>New</span> <span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="#">Projects</a></li>
					<li><a href=""><span class="badge bg-info pull-right">5</span> <span>Task</span></a></li>
					<li><a href="">User</a></li>
					<li class="divider"></li>
					<li><a href=""><span class="badge bg-danger pull-right">4</span> <span>Email</span></a></li>
				</ul>
			</li>
		</ul>
		<!-- / link and dropdown -->

		<!-- search form -->
		<form class="navbar-form navbar-form-sm navbar-left shift" data-target=".navbar-collapse">
			<div class="form-group">
				<div class="input-group">
					<input class="form-control input-sm bg-light no-border rounded padder" placeholder="Search projects..." type="text"> <span class="input-group-btn"><button class="btn btn-sm bg-light rounded" type="submit"><span class="input-group-btn fa fa-search"></span></button></span>
				</div>
			</div>
		</form>
		<!-- / search form -->
	</div>
	<!-- / navbar collapse -->
</header>