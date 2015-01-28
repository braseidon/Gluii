@extends('template.master')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Reset Password</div>
					<div class="panel-body">

						<form class="form-horizontal" role="form" method="POST" action="{{ route('auth/forgot-password') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

							<!-- Email -->
							{!! Form::group('email', 'Email Address', [4,6], function($name)
							{
								return Form::text($name, old('email'), ['class' => 'form-control']);
							}) !!}

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										Send Password Reset Link
									</button>
								</div>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
@endsection