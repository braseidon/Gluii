@extends('activity.activity')

@section('activity-title')
	@include('statuses.partials.author', ['status' => $activity->subject])
@overwrite

@section('activity-content')
	@include('statuses.partials.body', ['status' => $activity->subject])
@overwrite