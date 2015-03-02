@if($user->id == Auth::getUser()->id)
	<a href="{{ route('user/manage/photos/upload') }}" class="profile-pic">
		{!! $user->present()->photoThumb(160) !!}
		<span class="btn-change-photo btn btn-default btn-xs">Change Photo</span>
	</a>
@else
	<a href="#" class="profile-pic">
		{!! $user->present()->photoThumb(160) !!}
	</a>
@endif