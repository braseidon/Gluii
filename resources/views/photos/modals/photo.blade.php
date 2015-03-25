@extends('partials.modals.photo')

@section('title', 'View Photo')

@section('content')
	{!! $photo->present()->output('large') !!}
@stop