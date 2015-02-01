@extends('partials.modal')

@section('title')
	Send Message to {{ $user->username }}
@stop

@section('body')
	<!-- Message -->
	<div class="form-group">
		<label class="col-md-3 control-label" for="message">Message</label>
		<div class="col-md-9">
			<textarea class="form-control" name="message" rows="5"></textarea>
		</div>
	</div>
@stop

@section('form_class') form-horizontal @stop
@section('form_action') # @stop
@section('form_submit') Send Message @stop