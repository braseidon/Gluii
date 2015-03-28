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
	{{-- Likes + Comments --}}
	@include('activity.partials.interactions', ['activity' => $activity->subject, 'activityType' => $activity->name])
</section>