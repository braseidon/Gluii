<div class="col">
	<div class="vbox">
		<div class="row-row">
			<div class="cell">
				<div class="cell-inner">
					<div class="wrapper-md">
						@if (count($errors) > 0)
							<div class="alert alert-danger">
								<strong>Whoops!</strong> There were some problems with your input.<br><br>
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif

						@yield('content')

					</div>
				</div>
			</div>
		</div>
	</div>
</div>