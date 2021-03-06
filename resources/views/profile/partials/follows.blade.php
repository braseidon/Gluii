@if($user->id !== Auth::getUser()->id)
	<!-- Follow Button -->
	<form action="{{ route('user/follows', $user->id) }}" method="post" data-follows>
		{{-- CSRF --}}
		{{ Form::token() }}

		<!-- Button -->
		@if ($user->isFollowedBy(Auth::getUser()))
			<button type="submit" class="btn btn-danger btn-sm">
				<i class="fa fa-thumbs-o-down"></i> Unfollow
			</button>
		@else
			<button type="submit" class="btn btn-primary btn-sm">
				<i class="fa fa-thumbs-o-up"></i> Follow
			</button>
		@endif
	</form>
@endif