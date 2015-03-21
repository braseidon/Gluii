<li class="dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		<i class="icon icon-diamond fa-fw"></i>
		<span class="visible-xs-inline">Admin Menu</span>
	</a>
	<ul class="dropdown-menu w" role="menu">
		{{-- Users --}}
		<li{!! ! Route::is('admin/users*') ? '' : ' class="active"' !!}>
			<a href class="auto">
				<span class="pull-right text-muted">
					<i class="fa fa-fw fa-angle-right text"></i>
					<i class="fa fa-fw fa-angle-down text-active"></i>
				</span>
				<i class="icon-users icon text-muted"></i>
				<span class="font-bold">Users</span>
			</a>
			<ul class="nav nav-sub dk">
				<li class="nav-sub-header"><a href><span>Users</span></a></li>
				{!! HTML::liLinkRoute('admin/users', 'All Users') !!}
				{!! HTML::liLinkRoute('admin/users/create', 'Create User') !!}
			</ul>
		</li>
		{{-- Roles --}}
		<li{!! ! Route::is('admin/roles*') ? '' : ' class="active"' !!}>
			<a href class="auto">
				<span class="pull-right text-muted">
					<i class="fa fa-fw fa-angle-right text"></i>
					<i class="fa fa-fw fa-angle-down text-active"></i>
				</span>
				<i class="icon-energy icon text-muted"></i>
				<span class="font-bold">Roles</span>
			</a>
			<ul class="nav nav-sub dk">
				<li class="nav-sub-header"><a href><span>Roles</span></a></li>
				<li><a href="#">All Roles</a></li>
				<li><a href="#">Create Role</a></li>
			</ul>
		</li>
		<!-- ./admin/settings/app -->
		<!-- ./admin/settings/users -->
		<!-- ./admin/settings/photos -->
	</ul>
</li>
