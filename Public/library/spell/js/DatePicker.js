/**
 * Jquery File Uploader Pluign is required
 * 
 * @param jQuery $
 * 
 */
+function ($) {
    'use strict';
    (typeof $.spell === 'undefined' ? $.spell = {} : true);

    $(document).ready(function () {
        $('[spell-date-picker]').each(function () {
            $.spell.DatePicker(this);
        });
    });

    $.spell.DatePicker = function (element) {
        var $element = $(element);
        var me = this;

        this.init = function () {
            $element.datepicker({autoclose: true, format: 'dd/mm/yyyy', language: 'pt-BR'});
        };

        this.init();

        return this;
    };

}(jQuery);