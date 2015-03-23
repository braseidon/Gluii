@extends('account.template.template')

@section('title', 'Active Sessions')

@section('content')
	<section class="panel panel-default">
		<div class="panel-heading clearfix">
			<div class="pull-left">All Active Sessions</div>
			<div class="pull-right">
				<a href="{{ route('account/security/sessions/flush') }}" class="btn btn-xs btn-primary">End All Sessions Except Current</a>
				<a href="{{ route('account/security/sessions/flush-all') }}" class="btn btn-xs btn-primary">End All Sessions</a>
			</div>
		</div>
		<div class="panel-body">
			<div class="list-group">
				@foreach ($persistences as $index => $p)
					@if ($p->code === $persistence->check())
						<a href="{{ route('account/security/sessions/flush-code', $p->code) }}" class="list-group-item active">
							{{ $p->created_at->format('F d, Y - h:ia') }}
							<span class="label label-info">{{ $p->browser }}</span>
							<span class="badge">{{ $p->last_used }}</span>
							<span class="badge">You</span>
						</a>
					@else
						<a href="{{ route('account/security/sessions/flush-code', $p->code) }}" class="list-group-item">
							{{ $p->created_at->format('F d, Y - h:ia') }}
							<span class="label label-default">End Session</span>
						</a>
					@endif
				@endforeach
			</div>
		</div>
	</section>
@stop
