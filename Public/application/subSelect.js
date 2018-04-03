$(document).ready(function () {
    $('[sub-select]').each(function () {
        $(this).subSelect();
    });
});
+function ($) {
    'use strict';
    var subSelect = function (element) {
        var $element = $(element);
        var me = this;
        var $target = $($element.data('target'));
        var ws = $element.data('ws');
        var emptyValue = $element.data('emptyv');
        var emptyResult = $element.data('emptyr');
        var hasChosen = typeof $.fn.chosen !== 'undefined';
        //$target.data('value', $target.val());
        if (hasChosen) {
            $element.chosen();
            $target.chosen();
        }

        me.change = function () {
            $target.html('');
            $target.val('');
            $('<option/>').attr('value', '').html(emptyValue).appendTo($target);
            $('body').faLoading();

            $.getJSON(ws + '/' + $element.val(), function (json) {
                $target.removeAttr('disabled');

                if (json.data.length < 1) {
                    $target.html('');
                    $('<option/>').attr('value', '').html(emptyResult).appendTo($target);
                } else {
                    if (hasChosen)
                        $target.chosen('destroy');
                }

                $.each(json.data, function (k, label) {
                    $('<option/>').attr('value', k).html(label).appendTo($target);
                });
                
                if ($target.data('value')) {
                    $target.val($target.data('value'));
                    $target.data('value', false);
                }

                if (hasChosen) {
                    $target.chosen();
                    $target.trigger("chosen:updated");
                }
            })
            .always(function () {
                $('body').faLoading();
            });
        };

        $element.change(me.change);
        $target.attr('disabled', 'true');
        if ($element.val().length > 0)
            me.change();

        return this;
    };

    $.fn.subSelect = function () {
        if (!$(this).data('plugin.subSelect'))
            $(this).data('plugin.subSelect', (new subSelect(this)));

        return $(this).data('plugin.subSelect');
    };

    $.fn.subSelect.Constructor = subSelect;

}(jQuery);


