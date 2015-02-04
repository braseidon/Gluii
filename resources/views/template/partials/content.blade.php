@if(! empty(trim($__env->yieldContent('sidebar-left'))))
	<div class="row">
		<div class="col-md-4 col-lg-3">
		@yield('sidebar-left')
		</div>
		<div class="col-md-8 col-lg-9">
			@yield('content')
		</div>
	</div>
@else
	<div class="row">
		<div class="col-lg-12">
			@yield('content')
		</div>
	</div>
@endif