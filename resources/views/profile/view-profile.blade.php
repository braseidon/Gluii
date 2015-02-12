@extends('template.master')

@section('title', "{$user->username}'s Profile")

{{-- Page content --}}
@section('content')
	<section class="panel panel-default">
		<div class="panel-body">
			<div class="row">

				<!-- User Profile -->
				<div class="col-sm-12 col-md-12 col-lg-6">
					@include('profile.profile')
				</div>

				<!-- User Timeline -->
				<div class="col-sm-12 col-md-12 col-lg-6">
					@include('statuses.view-timeline')
				</div>
			</div>
		</div>
	</section>
@stop