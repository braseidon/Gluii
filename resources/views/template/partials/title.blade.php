@if(! empty(trim($__env->yieldContent('title'))))
	<div class="bg-light lter b-b wrapper-md ng-scope">
		<div class="container">
			@if(! empty(trim($__env->yieldContent('buttons'))))
				<div class="pull-right">
					{!! trim($__env->yieldContent('buttons')) !!}
				</div>
			@endif
			<h2 class="m-n font-thin">{!! trim($__env->yieldContent('title')) !!}</h2>
		</div>
	</div>
@endif