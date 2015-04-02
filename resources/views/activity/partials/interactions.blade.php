<footer class="panel-footer no-padder">
	<ul class="list-group no-borders no-radius m-b-none">
		{{-- Activity Stats --}}
		<li class="list-group-item clear b-t-none">
			@include('activity.partials.actions', ['activityType' => $activityType])
		</li>

		{{-- Comment Loop --}}
		@if(isset($activity->comments))
			@include('activity.partials.comments', ['comments' => $activity->comments->load(['author', 'likes'])])
		@endif

		{{-- New Comment --}}
		@if(Auth::check())
			<li class="list-group-item clear">
				@include('activity.forms.new-comment', ['activityType' => $activityType])
			</li>
		@endif
	</ul>
</footer>