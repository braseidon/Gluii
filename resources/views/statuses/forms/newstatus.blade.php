<form class="well m-b-sm" action="{{ route('user/status/new') }}" method="POST">
	{!! Form::group('status', null, false, function($name)
	{ return Form::textarea('status', null, ['class' => 'form-control', 'placeholder' => 'What are you thinking?', 'rows' => '2']); }) !!}
	<div class="m-t-sm">
		<a class="btn btn-link profile-link-btn fa fa-location-arrow text-underline-none" href="javascript:void(0);" {!! tooltip('Add Location', 'bottom') !!}></a>
		<a class="btn btn-link profile-link-btn fa fa-microphone text-underline-none" href="javascript:void(0);" {!! tooltip('Add Voice', 'bottom') !!}></a>
		<a class="btn btn-link profile-link-btn fa fa-camera text-underline-none" href="javascript:void(0);" {!! tooltip('Add Photo', 'bottom') !!}></a>
		<a class="btn btn-link profile-link-btn fa fa-file text-underline-none" href="javascript:void(0);" {!! tooltip('Add File', 'bottom') !!}></a>

		<!-- Profile User ID -->
		<input type="hidden" name="profile_user_id" value="{{ ! isset($user) ? Auth::user()->id : $user->id }}">
		<!-- CSRF -->
		{!! Form::token() !!}
		<button class="btn btn-sm btn-primary pull-right" type="submit">Post</button>
	</div>
</form>