@extends('template.master')

@section('content')
	<p>Hello</p>
{!! Form::group('email', 'Email', true, function($name)
{
	return Form::text($name, null, ['class' => 'form-control']);
}) !!}
@endsection