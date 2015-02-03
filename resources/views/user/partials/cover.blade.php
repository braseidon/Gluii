<div class="row">
	<div class="col-lg-12">
		<!-- cover photo -->
		<a href="#" class="cover-photo">
			<img alt="" src="/img/cover/default.jpg" alt="{!! $user->present()->name !!}">
		</a>
		<!-- profile pic -->
		<a href="#" class="profile-pic">
			{!! $user->present()->photoThumb(160) !!}
		</a>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<!-- name -->
		<h3 class="profile-name pull-left">{!! $user->first_name !!} <span class="font-bold">{!! $user->last_name !!}</span></h3>
		<!-- friend request -->
		<div class="pull-right m-t-xs">
			@include('user.partials.actions-friend')
		</div>
	</div>
</div>