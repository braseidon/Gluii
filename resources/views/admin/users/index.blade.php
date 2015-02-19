@extends('template.master')

@section('title', 'All Users')

@section('buttons')
	<a href="{{ route('admin/users/create') }}" class="btn btn-success btn-addon">
		<i class="icon icon-plus"></i> Create User
	</a>
@endsection

{{-- Page content --}}
@section('content')
	<section class="panel panel-default">
		<div class="panel-heading">
			Total Users: {{ $users->count() }}
		</div>
		<div class="panel-body">
			@include('admin.users.partials.pagination')
		</div>
		<div class="table-responsive">
			<table class="table table-striped">
				@include('admin.users.tables.users')
			</table>
		</div>
		<footer class="panel-footer">
			@include('admin.users.partials.pagination')
		</footer>
	</section>
@stop