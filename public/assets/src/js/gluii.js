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

	/**
	 * Ajax - Dynamic Data Grabber
	 *
	 * @return {string}
	 */
	$.fn.shutterAjaxForm = function()
	{
		var $form = $(this),
			$formAction = $form.attr('action'),
			$formSubmit = $form.find('button[type=submit]'),
			$ovalue = $formSubmit.html(),
			$dataOutputTarget = $($form.data('ajax-output'));

		// Disable button
		$formSubmit.attr('disabled','disabled');
		// Show loading
		$dataOutputTarget.shutterLoading();

		$.ajax({
			url: $form.attr('action'),
			type: $form.attr('method'),
			data: $form.serialize(),
			dataType: "JSON"
		})
		.done(function(data)
		{
			if(data.success === true)
			{
				// If ajax-output - replace object with returned HTML
				if (typeof $form.data('ajax-output') !== 'undefined')
				{
					$dataOutputTarget.html(data.projectsTable);
					$dataOutputTarget.shutterDoneLoading();
				}

				// If button-done is filled
				if (typeof $form.data('button-done') !== 'undefined')
				{
					var $formSubmitDone = $form.data('button-done');
					$formSubmit.addClass('btn-success');
					$formSubmit.html('<i class="fa fa-check"></i> ' + $formSubmitDone);
					setTimeout(resetForm, 4000);
				}
				else
				{
					resetForm();
				}

			}
			else
			{
				alert('<p>There was an error with your request. Please try again.</p>');

				resetForm();
			}
		})
		.fail(function(data)
		{
			var response = JSON.parse(data);

			alert('There was an error, try again. ' + response);

			resetForm();
		});

		// Reset form function
		function resetForm()
		{
			$formSubmit.html($ovalue);
			$formSubmit.removeAttr('disabled');
		}
	};

	// When data-autoload="true", auto-submit the form on load
	$('form[data-ajax-submit]').each(function()
	{
		var $this = $(this);

		if($this.data('autoload') == 'true')
		{
			$this.shutterAjaxForm();
		}
	});

	// Watch for form submit
	$('form[data-ajax-submit]').on('submit', function(e)
	{
		e.preventDefault();

		$(this).shutterAjaxForm();
	});

	/**
	 * Ajax - Data Getter (Autoload)
	 *
	 * @return {string}
	 */
	$.fn.shutterDataGetter = function()
	{
		var $this = $(this),
			$dataUrl = $(this).data('getter-url');

		// Show loading
		$this.shutterLoading();

		$.ajax({
			url: $dataUrl,
			type: "GET",
			dataType: "JSON"
		})
		.done(function(data)
		{
			$this.html(data.output);
			$this.shutterDoneLoading();
		})
		.fail(function(data)
		{
			$this.shutterError();
		});
	};

	$('[data-getter]').each(function()
	{
		$(this).shutterDataGetter();
	});

	/**
	 * Ajax - Dynamic Data Grabber
	 *
	 * @return {string}
	 */
	$.fn.shutterDropdownLoad = function()
	{
		var $this				= $(this),
			$dataContent		= $this.find('.ajax-content[data-ajax-url]'),
			$dataUrl			= $dataContent.data('ajax-url'),
			$dataUrlRefresh		= $this.closest('button.refresh-button');

		// Show loading
		$dataContent.shutterLoading();

		$.ajax({
			url: $dataUrl,
			type: "GET",
			dataType: "JSON"
		})
		.done(function(data)
		{
			$dataContent.html(data.output);
			$dataContent.shutterDoneLoading();
		})
		.fail(function(data)
		{
			$dataContent.shutterError();
		});
	};

	// On Bootstrap dropdown event, load the Ajax
	$('[data-toggle="ajax-dropdown"]').on('show.bs.dropdown', function(e)
	{
		$(this).shutterDropdownLoad();
	});

	/*
	|--------------------------------------------------------------------------
	| Loading / Error
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Loading - Start
	 *
	 * @return {[type]}
	 */
	$.fn.shutterLoading = function()
	{
		var $this = $(this);

		$this.html('<span class="m-t m-b block"><i class="fa fa-refresh fa-spin"></i> Loading...</span>');
		$this.addClass('text-center');
	};

	/**
	 * Loading - Finished
	 *
	 * @return {removeClass}
	 */
	$.fn.shutterDoneLoading = function()
	{
		var $this = $(this);

		$this.removeClass('text-center');
	};

	/**
	 * Replace HTML showing that an error occured
	 *
	 * @return {string}
	 */
	$.fn.shutterError = function()
	{
		var $this = $(this);

		$this.html('<span class="m-t m-b block text-center"><i class="fa fa-times text-danger"></i> Error loading content!</span>');
	};

	/*
	|--------------------------------------------------------------------------
	| Misc
	|--------------------------------------------------------------------------
	|
	|
	*/

	$.fn.invoke = function(name)
	{
		var args = Array.prototype.slice.call(arguments, 1);
		var ret;

		this.each(function() {
			ret = this[name].apply(this, args);
		});

		return typeof ret !== 'undefined' ? ret : this;
	};

	// table select/deselect all
	$(document).on('change', 'table thead [type="checkbox"]', function(e){
		e && e.preventDefault();
		var $table = $(e.target).closest('table'), $checked = $(e.target).is(':checked');
		$('tbody [type="checkbox"]',$table).prop('checked', $checked);
	});

});