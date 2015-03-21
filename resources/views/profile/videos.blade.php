@extends('profile.template.profile')

@section('title', $user->present()->name . ' - Videos')

@section('content')
	@parent

	{{-- timeline --}}
	<section class="panel panel-default">
		<div class="panel-body">
			<p>Insert imaginary video gallery here.</p>
		</div>
	</section>
@stop