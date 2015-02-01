@extends('backend.template.master')

{{-- Page title --}}
@section('title')
	{{ $user->username }}'s Profile
@stop

{{-- Page content --}}
@section('content')
	<section class="panel panel-default">
		<div class="panel-body">
			<div class="row">

				<!-- User Profile -->
				<div class="col-sm-12 col-md-12 col-lg-6">
					@include('backend.profile.profile')
				</div>

				<!-- User Timeline -->
				<div class="col-sm-12 col-md-12 col-lg-6">
					@include('backend.statuses.view-timeline')
				</div>
			</div>
		</div>
	</section>
@stop