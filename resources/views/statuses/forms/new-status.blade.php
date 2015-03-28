<section class="panel panel-default">
	<div class="panel-body">
		<form class="" action="{{ route('status/new') }}" method="POST">
			@if(Route::is('user/view') && isset($user))
				{!! Form::group('status', null, false, function($name) use ($user)
				{ return Form::textarea('status', null, ['class' => 'form-control', 'placeholder' => 'Write on ' . $user->first_name . '\'s timeline.', 'rows' => '2']); }) !!}
			@else
				{!! Form::group('status', null, false, function($name)
				{ return Form::textarea('status', null, ['class' => 'form-control', 'placeholder' => 'How are you feeling?', 'rows' => '2']); }) !!}
			@endif
			<div class="m-t-sm">
				<a class="btn btn-link profile-link-btn icon icon-map text-underline-none" href="javascript:void(0);" {!! tooltip('Add Location', 'bottom') !!}></a>
				<a class="btn btn-link profile-link-btn icon icon-microphone text-underline-none" href="javascript:void(0);" {!! tooltip('Add Voice', 'bottom') !!}></a>
				<a class="btn btn-link profile-link-btn icon icon-camera text-underline-none" href="javascript:void(0);" {!! tooltip('Add Photo', 'bottom') !!}></a>
				<a class="btn btn-link profile-link-btn icon icon-camcorder text-underline-none" href="javascript:void(0);" {!! tooltip('Add Video', 'bottom') !!}></a>

				{{-- Profile User ID --}}
				<input type="hidden" name="profile_user_id" value="{{ ! isset($user) ? Auth::getUser()->id : $user->id }}">
				{{-- CSRF --}}
				{!! Form::token() !!}
				<button class="btn btn-sm btn-primary pull-right" type="submit">Post</button>
			</div>
		</form>
	</div>
</section>