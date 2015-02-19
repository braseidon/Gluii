@extends('layouts.master')

{{-- Page title --}}
@section('title', 'Account Profile')

{{-- Inline styles --}}
@section('styles')
<link href="{{ URL::to('assets/css/account.css') }}" rel="stylesheet">
@stop

{{-- Page content --}}
@section('page')
<section class="account">

	<header class="text-right">
		<div class="btn-group">
			<a class="btn btn-default" href="{{ URL::route('user.edit_profile') }}">Edit Profile</a>
		</div>
	</header>

	<div class="col-sm-6 col-md-6 col-md-offset-3">

		<!-- Account -->
		<div class="row text-center">

			<div class="account__profile-image">
				<img src="{{ URL::to('assets/img/brand-sentinel.svg') }}" alt="Profile Image">
			</div>

			<p class="account__roles">
				@foreach ($currentUser->roles as $role)
				<span class="label label-default">{{ $role->name }}</span>
				@endforeach
			</p>

			<h3>{{ $currentUser->first_name }} {{ $currentUser->last_name }}<br><small>{{ $currentUser->email }}</small></h3>

			<p>“Dwell on the beauty of life. Watch the stars, and see yourself running with them.” ~ <small>Marcus Aurelius</small></p>

			<hr>

		</div>

		<div class="row">

			<!-- Active User Sessions -->
			<div class="panel panel-default">

				<div class="panel-heading clearfix">
					<div class="pull-left">Active Sessions</div>
					<div class="pull-right">
						<a href="{{ URL::to('account/flush') }}" class="btn btn-sm btn-default">Flush</a>
						<a href="{{ URL::to('account/flush-all') }}" class="btn btn-sm btn-default">Flush All</a>
					</div>
				</div>

				<div class="panel-body">

					<div class="list-group">

						@foreach ($currentUser->persistences as $index => $p)
						@if ($p->code === $persistence->check())
						<a href="{{ URL::to("account/flush/{$p->code}") }}" class="list-group-item active">
							{{ $p->created_at->format('F d, Y - h:ia') }}
							<span class="label label-info">{{ $p->browser }}</span>
							<span class="badge">{{ $p->last_used }}</span>
							<span class="badge">You</span>
						</a>
						@else
						<a href="{{ URL::to("account/flush/{$p->code}") }}" class="list-group-item">
							{{ $p->created_at->format('F d, Y - h:ia') }}
							<span class="label label-default">remove</span>
						</a>
						@endif
						@endforeach

					</div>

				</div>

			</div>

		</div>

	</div>

</section>
@stop

