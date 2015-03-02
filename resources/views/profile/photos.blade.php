@extends('profile.template.profile')

@section('title', $user->present()->name . ' - Photos')

@section('content')
	@parent

	{{-- timeline --}}
	<section class="panel panel-default">
		<div class="panel-body">
			{{-- Upload Photo --}}
			<a href="{{ route('user/manage/photos/upload') }}" class="btn btn-success btn-addon pull-right">
				<i class="icon icon-cloud-upload"></i> Upload a Photo
			</a>

			<p>Insert imaginary photo gallery here.</p>
		</div>
	</section>
@stop