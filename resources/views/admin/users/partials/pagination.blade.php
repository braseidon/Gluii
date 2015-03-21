<div class="row">
	<div class="col-xs-6 col-sm-6 col-lg-4">
		<div class="input-group m-t-lg m-b-md">
			<input type="text" class="input-sm form-control" placeholder="Search">
				<span class="input-group-btn">
				<button class="btn btn-sm btn-default" type="button">Go!</button>
			</span>
		</div>
	</div>
	<div class="col-xs-6 col-sm-6 col-lg-8 text-right text-center-xs-md-6">
		{!! $users->render() !!}
	</div>
</div>