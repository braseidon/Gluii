<a class="btn btn-default btn-xs" href="{{ route('admin/users/edit', $user->id) }}" {!! tooltip('Edit') !!}>
	<i class="icon icon-pencil fa-fw"></i>
</a>

@if ($currentUser->id != $user->id)
	<form class="inline" method="post" action="{{ route('admin/users/delete', $user->id) }}">
		{{-- CSRF Token --}}
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="delete">
		<button class="btn btn-danger btn-xs" {!! tooltip('Delete') !!}>
			<i class="icon icon-trash fa-fw"></i>
		</button>
	</form>
@endif