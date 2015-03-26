<ul class="list-inline m-t-sm m-b-none block">
	<!-- like -->
	<li><a href="javascript:void(0);" class="btn btn-link btn-sm text-muted"><i class="icon icon-like"></i> Like</a></li>
	<!-- comment -->
	<li><a href="javascript:void(0);" class="btn btn-link btn-sm text-muted"><i class="icon icon-bubble"></i> Comment</a></li>
	@if(Auth::getUser()->id == $comment->author->id)
		<li class="pull-right">
			<!-- edit -->
			<a href="javascript:void(0);" class="btn btn-link btn-sm text-muted">Edit</a>
			<!-- delete -->
			<!-- <a href="javascript:void(0);" class="btn btn-link btn-sm text-muted">Delete</a> -->
		</li>
	@endif
</ul>