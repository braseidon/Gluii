<section class="panel panel-default panel-status">
	<div class="panel-body">
		{{-- status actions dropdown --}}
		@if(Auth::check())
			@include('statuses.partials.status-dropdown')
		@endif
		{{-- status body --}}
		@include('statuses.partials.status-content')
		{{-- interactions --}}
		@include('statuses.partials.status-interactions')
	</div>
	<footer class="panel-footer">
		<ul class="list-group no-borders no-radius no-bg m-b-none auto">
			{{-- status likes display --}}
			<li class="list-group-item clear">
				@include('statuses.partials.status-likecount')
			</li>

			{{-- comments loop --}}
			@if(! $status->comments->isEmpty())
				@foreach($status->comments as $comment)
					<li class="list-group-item clear">
						@include('statuses.partials.comment')
					</li>
				@endforeach
			@endif

			{{-- new comment form --}}
			@if(Auth::check())
				<li class="list-group-item clear">
					@include('statuses.forms.new-comment')
				</li>
			@endif
		</ul>
	</footer>
</section>