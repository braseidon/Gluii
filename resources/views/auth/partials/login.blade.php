@if(! Auth::check())
	<section class="panel panel-default">
		<div class="panel-heading font-bold">
			Sign In
		</div>
		<form method="POST" action="{{ route('auth/login') }}" role="form">
			<div class="panel-body">
				<!-- Login Form -->
				@include('auth.forms.login')
			</div>
			<footer class="panel-footer">
				<!-- CSRF -->
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<button type="submit" class="btn btn-primary">Sign In</button>
				<a href="#" class="btn btn-link">
					Forgot Password?
				</a>
			</footer>
		</form>
	</section>
	@include('auth.partials.social')
@endif