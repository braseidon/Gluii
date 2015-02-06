$(function() {
	// Tooltips (live)
	$('body').tooltip({
		selector: '[data-toggle="tooltip"]',
		html: true
	});

	// Popovers (live)
	$('body').popover({
		selector: '[data-toggle="popover"]'
	});
});