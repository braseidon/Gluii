{{-- Left Sidebar --}}
@if(! empty(trim($__env->yieldContent('sidebar-left'))) && empty(trim($__env->yieldContent('sidebar-right'))))
	<div class="row">
		<div class="col-md-4 col-lg-3">
			@yield('sidebar-left')
		</div>
		<div class="col-md-8 col-lg-9">
			@yield('content')
		</div>
	</div>
{{-- Right Sidebar --}}
@elseif(empty(trim($__env->yieldContent('sidebar-left'))) && ! empty(trim($__env->yieldContent('sidebar-right'))))
	<div class="row">
		<div class="col-md-8 col-lg-9">
			@yield('content')
		</div>
		<div class="col-md-4 col-lg-3">
			@yield('sidebar-right')
		</div>
	</div>
{{-- Both Sidebars --}}
@elseif(! empty(trim($__env->yieldContent('sidebar-left'))) && ! empty(trim($__env->yieldContent('sidebar-right'))))
	<div class="row">
		<div class="col-md-3 col-lg-3">
			@yield('sidebar-left')
		</div>
		<div class="col-md-6 col-lg-6">
			@yield('content')
		</div>
		<div class="col-md-3 col-lg-3">
			@yield('sidebar-right')
		</div>
	</div>
{{-- Wrapped Content --}}
@else
	<div class="row">
		<div class="col-lg-12">
			@yield('content')
		</div>
	</div>
@endif