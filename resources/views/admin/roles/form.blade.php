@extends('layouts.master')

{{-- Page content --}}
@section('page')
<section class="role">

	<header class="page-header">
		<h1>{{ $mode == 'create' ? 'Create Role' : 'Update Role' }} <small>{{ $role->name }}</small></h1>
	</header>

	<div class="col-sm-6 col-md-6 col-md-offset-3">

		<form method="post" action="" autocomplete="off" class="validate-form">

			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="form-group{{ $errors->first('name', ' has-error') }}">

				<label for="name">Name</label>

				<input type="text" class="form-control" name="name" id="name" value="{{{ Input::old('name', $role->name) }}}" placeholder="Enter the role name." required autofocus>

				<span class="help-block">{{{ $errors->first('name', ':message') }}}</span>

			</div>

			<div class="form-group{{ $errors->first('slug', ' has-error') }}">

				<label for="slug">Slug</label>

				<input type="text" class="form-control" name="slug" id="slug" value="{{{ Input::old('slug', $role->slug) }}}" placeholder="Enter the role slug." required>

				<span class="help-block">{{{ $errors->first('slug', ':message') }}}</span>

			</div>

			<button type="submit" class="btn btn-default">Submit</button>

		</form>

	</div>

</section>
@stop
