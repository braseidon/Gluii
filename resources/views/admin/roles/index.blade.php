@extends('layouts.master')

{{-- Page title --}}
@section('title', 'Roles')

{{-- Page content --}}
@section('page')
<section class="roles">

	<header class="page-header">
		<h1>Roles <span class="pull-right"><a href="{{ URL::route('role.create') }}" class="btn btn-primary">Create</a></span></h1>
	</header>

	@if ($roles->count())

	Page {{ $roles->currentPage() }} of {{ $roles->lastPage() }}

	<div class="pull-right">
		{!! $roles->render() !!}
	</div>

	<br /><br />

	<table class="table table-bordered">
		<thead>
			<th class="col-lg-6">Name</th>
			<th class="col-lg-4">Slug</th>
			<th class="col-lg-2">Actions</th>
		</thead>
		<tbody>
			@foreach ($roles as $role)
			<tr>
				<td>{{ $role->name }}</td>
				<td>{{ $role->slug }}</td>
				<td class="actions clearfix">

					<a class="btn btn-sm btn-default pull-left" href="{{ URL::route('role.edit', $role->id) }}">Edit</a>

					@if ($role->users->count() === 0)
					<form method="post" action="{{ URL::route('role.delete', $role->id) }}">

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

	Page {{ $roles->currentPage() }} of {{ $roles->lastPage() }}

	<div class="pull-right">
		{!! $roles->render() !!}
	</div>
	@else
	<div class="well">

		Nothing to show here.

	</div>
	@endif

</section>
@stop
