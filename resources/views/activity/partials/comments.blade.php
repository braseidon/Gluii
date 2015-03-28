@foreach($comments as $comment)
	<li class="list-group-item clear">
		@include('activity.partials.comments.comment')
	</li>
@endforeach