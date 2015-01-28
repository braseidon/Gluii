@if(Auth::check())
	<ul class="nav navbar-nav navbar-right">
		<!-- notifications -->
		@include('template.header.notifications')
		<!-- user dropdown -->
		@include('template.header.user-menu')
	</ul>
@else
	<!-- login form -->
	<form class="navbar-form navbar-form-sm navbar-right shift" method="POST" action="{{ route('auth/login') }}" ui-shift="prependTo" data-target=".navbar-collapse" role="search">
		<!-- Email -->
		<div class="form-group">
			<input type="text" name="email" class="form-control input-sm bg-light rounded no-border padder" placeholder="Email">
		</div>
		<!-- Password -->
		<div class="form-group">
			<input type="password" name="password" class="form-control input-sm bg-light rounded no-border padder m-l-xs" placeholder="Password">
		</div>
		<!-- Remember -->
		<div class="form-group">
			<div class="checkbox m-l m-r-xs">
				<label class="i-checks">
					<input type="checkbox" name="remember"><i></i> Remember me
				</label>
			</div>
		</div>
		<!-- Log In -->
		{!! Form::token() !!}
		<button type="submit" class="btn btn-default btn-sm m-l-xs">Log In</button>
		<!-- Sign Up -->
		<a href="{{ route('auth/register') }}" class="btn btn-danger btn-sm m-l-xs">Sign Up</a>
	</form>
	<!-- / login form -->
@endif