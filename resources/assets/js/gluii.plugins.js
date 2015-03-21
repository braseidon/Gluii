$(function() {

	// Selectpicker [rel=""]
	// $('.selectpicker').selectpicker({
	// 	width: '100%'
	// });

	// Tooltips (live)
	$('body').tooltip({
		selector: '[rel="tooltip"]',
		container: 'body',
		html: true
	});

	// Popovers (live)
	$('body').popover({
		selector: '[data-toggle="popover"]',
		container: 'body'
	});

});

$(function() {

	/**
	 * Ajax Modal
	 */
	$(document).on('click', '[data-toggle="ajaxModal"]',
		function(e) {
			$('#ajaxModal').remove();
			e.preventDefault();
			var $this = $(this)
				, $remote = $this.data('remote') || $this.attr('href')
				, $modal = $('<div class="modal fade" id="ajaxModal"><div class="modal-body"></div></div>');
			$('body').append($modal);
			$modal.modal();
			$modal.load($remote);
		}
	);

	/**
	 * Button Loading
	 */
	$(document).on('click.button.data-api', '[data-loading-text]', function (e) {
			var $this = $(e.target);
			$this.is('i') && ($this = $this.parent());
			$this.button('loading');
	});

});