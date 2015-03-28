<footer class="panel-footer no-padder">
	<ul class="list-group no-borders no-radius m-b-none auto">
		{{-- Activity Stats --}}
		<li class="list-group-item clear">
			@include('activity.partials.actions', ['activityType' => $activityType])
		</li>

		{{-- Comment Loop --}}
		@if(isset($activity->comments))
			@include('activity.partials.comments', ['comments' => $activity->comments])
		@endif

		{{-- New Comment --}}
		@if(Auth::check())
			<li class="list-group-item clear">
				@include('activity.forms.new-comment', ['activityType' => $activityType])
			</li>
		@endif
	</ul>
</footer>