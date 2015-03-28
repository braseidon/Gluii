<div class="block">
	{{-- Auth User Thumbnail --}}
	<div class="pull-left block avatar thumb-xs">
		{!! Auth::getUser()->present()->photoThumb('thumb-sm', ['class' => 'no-radius']) !!}
	</div>
	<div class="block pos-rlt">
		<div class="activity-reply">
			{{-- New Comment Form --}}
			<form action="{{ route('activity/comment/new', $activityType) }}" method="POST">
				{{-- Activity ID --}}
				<input type="hidden" name="activity_id" value="{{ $activity->id }}">
				{{-- CSRF --}}
				{!! Form::token() !!}
				<input type="text" class="form-control" name="body" placeholder="Type and press enter">
			</form>
		</div>
	</div>
</div>