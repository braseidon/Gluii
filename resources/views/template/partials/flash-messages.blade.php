<!-- Success Status -->
@if(session('status'))
	<div class="alert alert-success">
		{{ session('status') }}
	</div>
@endif

{{-- Show Errors --}}
@if(isset($errors) && $errors->count() > 0)
	<div class="padder-v">
		<div class="alert alert-danger">
			<strong>Whoops!</strong> There were some problems with your input.<br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	</div>
@endif
{{-- Show Success --}}
@if ($message = Session::get('success'))
	<div class="padder-v">
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
	</div>
@endif