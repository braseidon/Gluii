@extends('template.master')

@section('title', $mode == 'create' ? 'Create User' : 'Edit User: ' . $user->present()->name . ' <span class="text-muted">(' . $user->email . ')</span>')

@section('buttons')
	<a href="{{ route('admin/users') }}" class="btn btn-default btn-addon">
		<i class="icon icon-action-undo"></i> Back
	</a>
@endsection

@section('content')
	<form method="post" action="" autocomplete="off" class="validate-form">
		<section class="panel panel-default">
			<header class="panel-heading">
				{{ $user->present()->name }}
			</header>
			<div class="panel-body">
				<div class="row">
					@include('admin.users.forms.edit')
				</div>
			</div>
			<footer class="panel-footer">
				@if ($user->exists && Auth::hasAccess('admin') && $currentUser->id != $user->id)
					@if (Activation::completed($user))
						<a class="btn btn-warning" href="{{ route('admin/users/deactivate', $user->id) }}">Deactivate</a>
					@else
						<a class="btn btn-primary" href="{{ route('admin/users/reactivate', $user->id) }}">Activate</a>
					@endif
					<!-- form is ILLEGALLLLL -->
					<form class="form-inline" method="post" action="{{ route('admin/users/delete', $user->id) }}">
						{{-- CSRF Token --}}
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<button class="btn btn-danger">Delete</button>
					</form>
				@endif
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<!-- right controls -->
				<div class="pull-right">
					<!-- cancel -->
					<a class="btn btn-default" href="{{ route('admin/users') }}">Cancel</a>
					<!-- submit -->
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</footer>
	</form>
@stop