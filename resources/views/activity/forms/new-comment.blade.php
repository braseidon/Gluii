<div class="block">
	{{-- Auth User Thumbnail --}}
	<div class="pull-left block avatar thumb-xs">
		{!! Auth::getUser()->present()->photoThumb('thumb-sm', ['class' => 'no-radius']) !!}
		{!! Auth::getUser()->present()->onlineStatus !!}
	</div>
	<div class="block pos-rlt">
		<div class="activity-reply">
			<!-- the form -->
			<form action="{{-- route('activity/comment/new') --}}" method="POST">
				<!-- Status ID -->
				<input type="hidden" name="activity_id" value="{{ $activity->subject_id }}">
				<!-- Form Token -->
				{!! Form::token() !!}
				<input type="text" class="form-control" name="body" placeholder="Type and press enter">
			</form>
		</div>
	</div>
</div>