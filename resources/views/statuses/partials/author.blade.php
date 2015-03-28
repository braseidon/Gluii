<a href="{{ route('user/view', $status->user->username) }}" class="username">
	{{ $status->user->present()->name }}
</a>
{{-- If Status user didn't post to his own wall --}}
@if($status->user_id !== $status->profile_user_id)
	wrote on
	<a href="{{ route('user/view', $status->profileuser->username) }}" class="username">
		{{ $status->profileuser->present()->name }}'s
	</a> wall.
@endif