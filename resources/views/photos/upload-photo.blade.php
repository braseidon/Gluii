@extends('profile.template.profile')

@section('title', 'Upload a New Photo')

@section('content')
	@parent

	<section class="panel panel-default">
		<div class="panel-body">

			{{-- If user has no Profile Photo --}}
			@if(Auth::getUser()->profilepic == null)
				<div class="alert alert-info"><p>You don't have a profile photo! Start by uploading one below.</p></div>
			@else
				{{-- Display Photo --}}
			@endif

			<div class="row">
				<div class="col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6">

					<div class="well">
						{{-- Upload a Photo --}}
						@include('photos.forms.uploadphoto')
					</div>

				</div>
			</div>
		</div>
	</section>
@stop

{{-- Assets --}}
@section('assets-footer')
	@parent
	{!! HTML::script('/assets/src/js/cropper/cropper.min.js') !!}
	{!! HTML::script('/assets/src/js/cropper/gluii.cropper.js') !!}
@stop
@section('assets-header')
	@parent
	{!! HTML::style('/assets/src/js/cropper/cropper.min.css') !!}
	{!! HTML::style('/assets/src/js/cropper/gluii.cropper.css') !!}
@stop