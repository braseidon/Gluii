<form class="well m-b-sm" action="" method="POST">
	<textarea class="form-control" name="body" placeholder="What are you thinking?" rows="2"></textarea>
	<div class="m-t-sm">
		<a class="btn btn-link profile-link-btn fa fa-location-arrow text-underline-none" href="javascript:void(0);" {!! tooltip('Add Location', 'bottom') !!}></a>
		<a class="btn btn-link profile-link-btn fa fa-microphone text-underline-none" href="javascript:void(0);" {!! tooltip('Add Voice', 'bottom') !!}></a>
		<a class="btn btn-link profile-link-btn fa fa-camera text-underline-none" href="javascript:void(0);" {!! tooltip('Add Photo', 'bottom') !!}></a>
		<a class="btn btn-link profile-link-btn fa fa-file text-underline-none" href="javascript:void(0);" {!! tooltip('Add File', 'bottom') !!}></a>

		<!-- CSRF -->
		<input type="hidden" name="_token" value="{!! csrf_token() !!}">
		<button class="btn btn-sm btn-primary pull-right" type="submit">Post</button>
	</div>
</form>