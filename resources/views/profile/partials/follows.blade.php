@if($user->id !== $currentUser->id)
	<!-- Follow Button -->
	<form action="{{ route('user/follows', $user->id) }}" method="post" data-follows>
		<!-- Form Token -->
		{{ Form::token() }}

		<!-- Button -->
		@if ($user->isFollowedBy($currentUser))
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