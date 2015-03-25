<section class="panel panel-default">
	<div class="panel-body">
		<p>{{ $activity->user->present()->name }} commented on a status {{ $activity->created_at->diffForHumans() }}.</p>
	</div>
</section>