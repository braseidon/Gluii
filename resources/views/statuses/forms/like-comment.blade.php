@if($comment->isLikedBy(Auth::user()))
	<form class="inline" action="{{ route('status/comment/unlike') }}" method="POST">
		{!! Form::hidden('comment_id', $comment->id) !!}
		{!! Form::token() !!}
		<button type="submit" class="btn btn-link btn-sm text-base">
			Unlike
		</button>
	</form>
@else
	<form class="inline" action="{{ route('status/comment/like') }}" method="POST">
		{!! Form::hidden('comment_id', $comment->id) !!}
		{!! Form::token() !!}
		<button type="submit" class="btn btn-link btn-sm text-base">
			Like
		</button>
	</form>
@endif