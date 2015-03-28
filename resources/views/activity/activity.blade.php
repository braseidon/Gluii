<section class="panel panel-default panel-activity">
	<div class="panel-body">
		<div class="block m-b-sm">
			{{-- Dropdown --}}
			@if(Auth::check())
				@include('activity.partials.dropdown')
			@endif
			{{-- Activity Author --}}
			@include('activity.partials.author')
		</div>

		{{-- Activity Content --}}
		{!! trim($__env->yieldContent('activity-content')) !!}

	</div>
	<footer class="panel-footer no-padder">
		<ul class="list-group no-borders no-radius m-b-none auto">

			{{-- Activity Stats --}}
			<li class="list-group-item bg-light clear">
				@include('activity.partials.likecount')
			</li>

			{{-- Comment Loop --}}
			@if(isset($activity->subject->comments) && ! $activity->subject->comments->isEmpty())
				@foreach($activity->subject->comments as $comment)
					<li class="list-group-item clear">
						@include('activity.partials.comments.comment')
					</li>
				@endforeach
			@endif

			{{-- New Comment --}}
			@if(Auth::check())
				<li class="list-group-item clear">
					@include('activity.forms.new-comment')
				</li>
			@endif
		</ul>
	</footer>
</section>