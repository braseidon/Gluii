<div class="block">
	<!-- reply photo -->
	<div class="pull-left block avatar thumb-xs">
		{!! Auth::getUser()->present()->photoThumb('thumb-sm', ['class' => 'no-radius']) !!}
		{!! Auth::getUser()->present()->onlineStatus !!}
	</div>
	<div class="block pos-rlt">
		<div class="status-reply">
			<!-- the form -->
			<form action="{{ route('status/comment/new') }}" method="POST">
				<!-- Status ID -->
				<input type="hidden" name="status_id" value="{{ $status->id }}">
				<!-- Form Token -->
				{!! Form::token() !!}
				<input type="text" class="form-control" name="body" placeholder="Type and press enter">
			</form>
		</div>
	</div>
</div>