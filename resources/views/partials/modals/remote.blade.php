<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">
				@yield('title')
			</h4>
		</div>
		{{-- Form Start --}}
		<form class="{{ trim($__env->yieldContent('form_class')) }}" action="{{ trim($__env->yieldContent('form_action')) }}" method="{{ trim($__env->yieldContent('form_method', 'POST')) }}">
			{{-- Modal Body --}}
			<div class="modal-body">
				@yield('content')
			</div>
			{{-- Modal Footer --}}
			<div class="modal-footer">
				{{-- CSRF Token --}}
				{{ Form::token() }}
				{{-- Form Submit | Close --}}
				@if(trim($__env->yieldContent('form_submit')))
					<a class="btn btn-default" data-dismiss="modal" href="#">Close</a>
					<button type="submit" class="btn btn-primary">{{ trim($__env->yieldContent('form_submit')) }}</button>
				@else
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				@endif
			</div><!-- /.modal-footer -->
		</form>
		{{-- Form End --}}
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->