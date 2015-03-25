<div class="profile-pic">
	<a href="{{ $user->present()->getProfilePicUrl('large') }}" data-toggle="lightbox" data-title="{{ $user->present()->name }}" class="profile-pic-img">
		{!! $user->present()->photoThumb('thumb-lg') !!}
	</a>
	@if(Auth::check() && $user->id == Auth::getUser()->id)
		<a href="{{ route('user/manage/photos/upload') }}" class="profile-pic-change btn btn-default btn-xs">
			Change Photo
		</a>
	@endif
</div>