<section class="panel panel-default m-b">
	<header class="panel-heading">
		<a href="#" class="font-bold text-black">Photos</a>
		(231)
	</header>
	<div class="panel-body no-padder">
		<div class="row userprofile-sidebar-list no-gutter">
			@for($x = 0;$x < 12;$x++)
				<div class="col-md-4 col-lg-3">
					<a href="#">
						{!! $user->present()->photoThumb('thumb-sm', ['class' => 'userprofile-sidebar-list-item']) !!}
					</a>
				</div>
			@endfor
		</div>
	</div>
</section>