+function ($) {
    'use strict';

    if (typeof $.spell === 'undefined')
        $.spell = {};

    $.spell.HTML = function (obj) {
        if (typeof obj === 'string') {
            return obj;
        } else if (obj instanceof Array) {
            var contents = [];
            $.each(obj, function (k, child) {
                contents.push($.spell.HTML(child));
            });
            return contents.join('');
        }


        var $element = $('<' + obj.tag + '/>');
        delete obj.tag;
        if (typeof obj.content !== 'undefined') {
            $element.html($.spell.HTML(obj.content));
            delete obj.content;
        }


        $.each(obj, function (k, p) {
            $element.attr(k, p);
        });

        return $element[0].outerHTML;
    };

}(jQuery);

