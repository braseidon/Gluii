<li class="dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown" {!! tooltip('Admin Menu', 'bottom') !!}>
		<i class="icon icon-diamond fa-fw"></i>
		<span class="visible-xs-inline">Admin Menu</span>
	</a>
	<ul class="dropdown-menu w" role="menu">
		{{-- Users --}}
		<li class="dropdown-submenu{!! ! Route::is('admin/users*') ? '' : ' active' !!}">
			<a href="#">
				<i class="fa fa-angle-right pull-right m-t-xs text-xs icon-muted"></i>
				<i class="icon-users icon text-muted"></i>
				<span>Users</span>
			</a>
			<ul class="dropdown-menu">
				<li class="nav-sub-header"><a href><span>Users</span></a></li>
				{!! HTML::liLinkRoute('admin/users', 'All Users') !!}
				{!! HTML::liLinkRoute('admin/users/create', 'Create User') !!}
			</ul>
		</li>
		{{-- Roles --}}
		<li class="dropdown-submenu{!! ! Route::is('admin/roles*') ? '' : ' active' !!}">
			<a href="#">
				<i class="fa fa-angle-right pull-right m-t-xs text-xs icon-muted"></i>
				<i class="icon-energy icon text-muted"></i>
				<span>Roles</span>
			</a>
			<ul class="dropdown-menu">
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
