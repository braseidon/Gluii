@extends('template.master')

@section('title')
	Welcome to Gluii
@endsection

@section('content')
	{{-- post new status --}}
	@include('statuses.forms.newstatus')

	<h2>Howdy!</h2>
	<p>A team of monkeys have been dispatched to make sure that this page is fininshed before the next time you see it.</p>
@endsection