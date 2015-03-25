<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">
				@yield('title')
			</h4>
		</div>
		{{-- Modal Body --}}
		<div class="modal-body">
			@yield('content')
		</div>
		{{-- Modal Footer --}}
		{{--<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div><!-- /.modal-footer -->--}}
		{{-- Form End --}}
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->