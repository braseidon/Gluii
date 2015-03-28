<section class="panel panel-default">
	<div class="panel-body">
		@include('statuses.partials.author')

		@include('statuses.partials.body')
	</div>
	@include('activity.partials.interactions', ['activity' => $status])
</section>