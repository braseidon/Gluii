@extends('layouts.master')

{{-- Page title --}}
@section('title', 'Users')

{{-- Page content --}}
@section('page')
<section class="users">

	<header class="page-header">
		<h1>Users <span class="pull-right"><a href="{{ URL::route('user.create') }}" class="btn btn-primary">Create</a></span></h1>
	</header>

	Page {{ $users->currentPage() }} of {{ $users->lastPage() }}

	<div class="pull-right">
		{!! $users->render() !!}
	</div>

	<br /><br />

	<table class="table table-bordered">
		<thead>
			<th class="col-lg-6">Name</th>
			<th class="col-lg-4">Email</th>
			<th class="col-lg-2">Actions</th>
		</thead>
		<tbody>
			@foreach ($users as $user)
			<tr>
				<td>{{ $user->first_name }} {{ $user->last_name }}</td>
				<td>{{ $user->email }}</td>
				<td class="actions clearfix">

					<a class="btn btn-sm btn-default pull-left" href="{{ URL::route('user.edit', $user->id) }}">Edit</a>

					@if ($currentUser->id != $user->id)
					<form method="post" action="{{ URL::route('user.delete', $user->id) }}">

						{{-- CSRF Token --}}
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<input type="hidden" name="_method" value="delete">

						<button class="btn btn-sm btn-danger pull-left">Delete</button>

					</form>
					@endif

				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	Page {{ $users->currentPage() }} of {{ $users->lastPage() }}

	<div class="pull-right">
		{!! $users->render() !!}
	</div>

</section>
@stop
