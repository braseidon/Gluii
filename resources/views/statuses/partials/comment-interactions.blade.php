<!-- time posted -->
<span class="btn btn-link btn-sm text-muted">
	{{ $comment->created_at->diffForHumans() }}
</span>
<!-- like -->
@include('statuses.forms.like-comment')
<!-- like count -->
@if(! $comment->likes->isEmpty())
	<button type="button" class="btn btn-link btn-sm text-base" {{--{!! tooltip($comment->likes->first()->present()->name . ' likes this', 'right') !!}--}}>
		<i class="icon icon-like m-r-xs"></i> {{ $comment->likes->count() }}
	</button>
@endif