<h3 class="page-header m-t-none">Upload New Profile Photo</h3>
<form class="gcrop-form" action="{{ route('user/manage/photos/upload') }}" enctype="multipart/form-data" method="POST">

	<div class="form-group gcrop-upload">
		<label class="control-label" for="image">File input</label>
		<input type="file" class="form-control" id="image" name="image" />
	</div>

	<!-- Crop and preview -->
	@if(isset($cropPreview))
		<div class="row">
			<div class="col-md-9">
				<div class="gcrop-container">
					<img src="{{ $cropPreview }}" alt="" />
				</div>
			</div>
			<div class="col-md-3">
				<div class="gcrop-preview">
					<img src="{{ $cropPreview }}" alt="" />
				</div>
			</div>
		</div>
	@endif

	<div class="form-group">
		{!! Form::token() !!}
		<button type="submit" class="btn btn-success btn-addon">
			<i class="icon icon-cloud-upload"></i> Upload Image
		</button>
	</div>

</form>