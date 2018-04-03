/**
 * 
 * @param {type} $
 * @returns {undefined}
 */
+function ($) {
    'use strict';
    (typeof $.spell === 'undefined' ? $.spell = {} : true);

    $(document).ready(function () {
        $('[spell-confirm-redirect]').each(function () {
            $.spell.ConfirmRedirect(this);
        });
    });

    $.spell.ConfirmRedirect = function (element) {
        var $element = $(element);
        var me = this;
        
        me.click = function (e) {
            e.preventDefault();
            var url = $(element).attr('href');
            var message = $(element).data('message');
            var redirect = $(element).data('redirect');
            var msg = $.spell.HTML({tag: 'h3', content: message, class: 'text-center'});
            window.bootbox.confirm(msg, function (result) {
                if (!result)
                    return;

                $.getJSON(url, function (data) {
                    if (!data.success)
                        return;

                    window.location.href = redirect;
                });
            });
        };
        
        this.init = function () {
            $element.click(me.click);
        };

        this.init();

        return this;
    };

}(jQuery);