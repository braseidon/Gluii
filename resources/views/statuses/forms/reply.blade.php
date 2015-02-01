<li class="message message-reply">
	<form action="{{ route('social/reply-status') }}" method="POST">
		<input type="text" class="form-control input-xs" name="body" placeholder="Type and enter">
		<!-- Status ID -->
		<input type="hidden" name="status_id" value="{{ $status->id }}">
		<!-- Form Token -->
		{{ Form::token() }}
	</form>
</li>