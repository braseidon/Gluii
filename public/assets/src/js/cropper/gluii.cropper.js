+function ($) {
	$(function(){
		$('.gcrop--container > img').cropper({
			aspectRatio: 1 / 1,
			preview: 'gcrop-preview',
			autoCropArea: 0,
			autoCrop: false,
			zoomable: false,
			crop: function(data) {
				// Output the result data for cropping image.
			}
		});
	});
}(jQuery);