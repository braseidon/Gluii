<div id="profile-cover" class="row">
	<div class="col-lg-12">
		{{-- Cover Photo --}}
		<div class="cover-photo">
			<img src="/images/covers/tomorrowworld.jpg" alt="{!! $user->present()->name !!}" />
		</div>
		{{-- Profile Picture --}}
		@include('profile.partials.profilepic')
		{{-- Friend Fequest / Friend Options --}}
		@include('profile.partials.actions-friend')
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		{{-- Name --}}
		<h3 class="profile-name pull-left">{!! $user->first_name !!} <span class="font-bold">{!! $user->last_name !!}</span></h3>
	</div>
</div>