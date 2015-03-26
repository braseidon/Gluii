$(function() {

    // Selectpicker [rel=""]
    // $('.selectpicker').selectpicker({
    //  width: '100%'
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

    // Slimscroll
    $(function(){
        $('.slimscroll').slimScroll();
    });

    // Bootstrap 3 Lightbox
    $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
        event.preventDefault();
        return $(this).ekkoLightbox({
            always_show_close: true,
            left_arrow_class: '.icon .icon-arrow-left',
            right_arrow_class: '.icon .icon-arrow-right'
        });
    });

    // Modal - Ajax
    $(document).on('click', '[data-toggle="ajaxModal"]',
        function(e) {
            $('#ajaxModal').remove();
            e.preventDefault();
            var $this = $(this),
                $remote = $this.data('remote') || $this.attr('href'),
                $type   = $this.data('type') || '',
                $modal  = $('<div class="modal fade ' + $type + '" id="ajaxModal"><div class="modal-body"></div></div>');
            $('body').append($modal);
            $modal.modal();
            $modal.load($remote);
        }
    );

    // Button Loading Text
    $(document).on('click.button.data-api', '[data-loading-text]', function (e) {
        var $this = $(e.target);
        $this.is('i') && ($this = $this.parent());
        $this.button('loading');
    });

});