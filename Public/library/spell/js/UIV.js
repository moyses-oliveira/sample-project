+function ($) {
    'use strict';
    $.spell.UIVariables = false;
    $.spell.UIV = function() {
        if($.spell.UIVariables === false) {
            var $script = $('script[property="uiv"]');
            $.spell.UIVariables = $script.length > 0 ? JSON.parse($script.html()) : {};
        };
        return $.spell.UIVariables;
    };
}(jQuery);

