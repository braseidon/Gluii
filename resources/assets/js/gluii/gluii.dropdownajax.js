+function ($) {
  'use strict';

  /**
   * Ajax - Dynamic Data Grabber
   *
   * @return {string}
   */
  $.fn.shutterDropdownAjax = function()
  {
    var $this       = $(this),
      $dataContent    = $this.find('.ajax-content[data-ajax-url]'),
      $dataUrl      = $dataContent.data('ajax-url'),
      $dataUrlRefresh   = $this.closest('button.refresh-button');

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

  // APPLY TO THE ELEMENTS
  // ===================================
  $(document).on('show.bs.dropdown', '[data-toggle="ajax-dropdown"]', shutterDropdownAjax)


}(jQuery);