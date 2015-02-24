@extends('template.master')

@section('title', "We're Close!")

@section('content_full')
	<div class="bg-primary lt clear">
		<div class="container">
			<div class="wrapper-xl text-center">
				<h1>Gluii is almost here!</h1>
				<h4>Our long awaited beta release is close to dropping. Make sure you know when we do!</h4>
			</div>
		</div>
	</div>

	<div class="bg-dark">
		<div class="container padder-v">

			<div class="row">
				<div class="col-lg-12 text-center">
					<form class="form-inline" action="" method="POST">
						<div class="form-group">
							<div class="input-group input-group-lg">
								{!! Form::text('email', Input::old('email'), ['class' => 'form-control w-md', 'placeholder' => 'Your Email']) !!}
									<span class="input-group-btn">
									<button class="btn btn-default" type="button">Be Notified</button>
								</span>
							</div>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
@stop