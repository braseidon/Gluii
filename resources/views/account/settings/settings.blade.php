@extends('account.template.template')

@section('title', 'Settings')

@section('content')
	<section class="panel panel-default">
		<div class="panel-body">
			<h4 class="page-header m-t-none">General Settings</h4>

			<form action="{{ route('account/settings') }}" method="POST">
				{{-- Username / Profile URL --}}
				{!! Form::groupOpen('username', 'Profile URL') !!}
					<div class="input-group">
						<span class="input-group-addon">
							{{ route('user/view', '') }}/
						</span>
						{!! Form::text('username', old('username', Auth::getUser()->username), ['class' => 'form-control', 'placeholder' => 'No URL Set']); !!}
					</div>
				{!! Form::groupClose('username', "Must contain at least one letter.") !!}

				<hr>

				{{-- CSRF --}}
				{!! Form::token() !!}
				<button type="submit" class="btn btn-primary">Update Settings</button>
			</form>
		</div>
	</section>
@stop
