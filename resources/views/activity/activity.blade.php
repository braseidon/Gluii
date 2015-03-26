<section class="panel panel-default panel-activity">
	@if(trim($__env->yieldContent('activity-title')))
		<header class="panel-heading">
			{!! trim($__env->yieldContent('activity-title')) !!}
		</header>
	@endif
	<div class="panel-body">
		{{-- Activity Author --}}
		{{-- @include('activity.partials.author') --}}
		{{-- Dropdown --}}
		@if(Auth::check())
			{{-- @include('activity.partials.dropdown') --}}
		@endif

		{{-- Activity Content --}}
		{!! trim($__env->yieldContent('activity-content')) !!}

	</div>
	<footer class="panel-footer">
		<ul class="list-group no-borders no-radius no-bg m-b-none auto">

			{{-- Activity Stats --}}
			<li class="list-group-item clear">
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