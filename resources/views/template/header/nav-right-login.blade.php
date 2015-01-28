<form class="navbar-form navbar-form-sm navbar-right shift" method="POST" action="{{ route('auth/login') }}" ui-shift="prependTo" data-target=".navbar-collapse" role="search">

	<!-- Email -->
	<div class="form-group">
		<input type="text" name="email" class="form-control input-sm padder" placeholder="Email">
	</div>

	<!-- Password -->
	<div class="form-group">
		<input type="password" name="password" class="form-control input-sm padder m-l-xs" placeholder="Password">
	</div>

	<!-- Remember -->
	<div class="form-group">
		<div class="checkbox m-l m-r-xs">
			<label class="i-checks">
				<input type="checkbox" name="remember"><i></i> Remember me
			</label>
		</div>
	</div>

	<!-- Submit -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<button type="submit" class="btn btn-default btn-sm m-l-xs">Log In</button>
</form>