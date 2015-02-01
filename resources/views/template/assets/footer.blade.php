<script src="/assets/js/app.min.js"></script>
<script>
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
</script>