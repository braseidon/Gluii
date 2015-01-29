@if(! Auth::check())
	<section class="panel panel-default">
		<div class="panel-heading font-bold">
			Create an Account
		</div>
		<form method="POST" action="{{ route('auth/register') }}" role="form">
			<div class="panel-body">
				<!-- Registration Form -->
				@include('auth.forms.register')
			</div>
			<footer class="panel-footer">
				<!-- CSRF -->
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<button type="submit" class="btn btn-primary">Create Account</button>
			</footer>
		</form>
	</section>
	@include('auth.partials.social')
@endif