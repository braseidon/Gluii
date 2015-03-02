<div id="profile-cover" class="row">
	<div class="col-lg-12">
		{{-- Cover Photo --}}
		<div class="cover-photo">
			<img src="/images/covers/tomorrowworld.jpg" alt="{!! $user->present()->name !!}" />
		</div>
		{{-- Friend Fequest --}}
		<div class="friend-buttons">
			@include('profile.partials.actions-friend')
		</div>
		{{-- Profile Picture --}}
		<div class="profile-pic-container">
			@include('profile.partials.profilepic')
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="clear padder">
			{{-- Name --}}
			<h3 class="profile-name pull-left">{!! $user->first_name !!} <span class="font-bold">{!! $user->last_name !!}</span></h3>
			<div class="profile-navigation m-t-xs">
				{{-- Profile Navigation --}}
				@include('profile.partials.navigation')
			</div>
		</div>
	</div>
</div>