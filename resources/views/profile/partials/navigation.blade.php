<div class="row">
	<div class="col-lg-12">
		<ul class="profile-navigation nav nav-tabs nav-content" role="menu">
			{{-- Timeline --}}
			<li{!! ! Route::is('user/view') ? '' : ' class="active"' !!}>
				<a href="{{ route('user/view', $user->id) }}">
					<i class="icon icon-camera fa-fw m-r-xs"></i> Timeline
				</a>
			</li>
			{{-- Photos --}}
			<li{!! (! Route::is('user/photos') and ! Route::is('user/manage/photos*')) ? '' : ' class="active"' !!}>
				<a href="{{ route('user/photos', $user->id) }}">
					<i class="icon icon-camera fa-fw m-r-xs"></i> Photos
				</a>
			</li>
			{!! HTML::liIconLink('user/videos', 'Videos', 'icon icon-camcorder', $user->id) !!}
			{!! HTML::liIconLink('user/calendar', 'Calendar', 'icon icon-calendar', $user->id) !!}
		</ul>
	</div>
</div>