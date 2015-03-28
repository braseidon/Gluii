@extends('profile.template.profile')

@section('title', $user->present()->name . ' - Calendar')

@section('content')
	@parent

	{{-- Timeline --}}
	<section class="panel panel-default">
		<div class="panel-body">
			<p>Insert imaginary calendar here.</p>
		</div>
	</section>
@stop