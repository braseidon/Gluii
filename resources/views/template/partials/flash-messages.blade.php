<!-- Success Status -->
@if(session('status'))
	<div class="alert alert-success">
		{{ session('status') }}
	</div>
@endif

{{-- Show Errors --}}
@if(isset($errors) && $errors->count() > 0)
	<div class="alert alert-danger alert-dismissible m-t m-b">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong>Whoops!</strong> There were some problems with your input.<br><br>
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
{{-- Show Success --}}
@if ($message = Session::get('success'))
	<div class="alert alert-success alert-dismissible m-t m-b">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<p>{{ $message }}</p>
	</div>
@endif