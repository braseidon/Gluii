@extends('template.master')

@section('content')
	<div class="row no-gutter text-center">
		<div class="col-lg-12">
			<!-- <img src="/images/slides/eletric_forest_banner.jpg" class="img-full" /> -->
		</div>
	</div>
	<div class="row">
		<!-- left column -->
		<div class="col-lg-6">
			<h3>Reconnect with the family you meet at festivals around the world.</h3>
		</div>
		<!-- right column -->
		<div class="col-lg-5 col-lg-offset-1">
			<h2 class="m-t-none">
				Join the family.. <span class="font-thin">it's free!</span>
			</h2>
			<section class="panel panel-default">
				<div class="panel-heading font-bold">
					Create a Free Gluii Account
				</div>
				<form method="POST" action="{{ route('auth/register') }}" role="form">
					<div class="panel-body">
						<!-- Registration Form -->
						@include('auth.forms.register')
					</div>
					<footer class="panel-footer">
						<button type="submit" class="btn btn-primary">Sign up</button>
					</footer>
				</form>
			</section>
		</div>
	</div>
@endsection