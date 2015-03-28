<form class="navbar-form navbar-form-sm navbar-left shift" ui-shift="prependTo" data-target=".navbar-collapse" role="search">
	<div class="form-group">
		<div class="input-group">
			<input type="text" class="form-control input-sm bg-light no-border rounded padder" placeholder="Search all of {{ Config::get('gluii.appname') }}">
			<span class="input-group-btn">
				<button type="submit" class="btn btn-sm bg-light rounded"><i class="icon icon-magnifier"></i></button>
			</span>
		</div>
	</div>
</form>