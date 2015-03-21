<div class="profile-pic">
	<a href="#" class="profile-pic-img">
		{!! $user->present()->photoThumb('thumb-lg') !!}
	</a>
	@if($user->id == Auth::getUser()->id)
		<a href="{{ route('user/manage/photos/upload') }}" class="profile-pic-change btn btn-default btn-xs">
			Change Photo
		</a>
	@endif
</div>