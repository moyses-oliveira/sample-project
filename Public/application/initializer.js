(function ($) {
    "use strict";
    $(document).ready(function () {
        if (typeof $.fn.inputmask !== 'undefined') {
            $('[data-mask]').each(function () {
                $(this).inputmask();
            });
            $('[data-money]').each(function () {
                $(this).inputmask("currency", {radixPoint: ',', groupSeparator: '.', prefix: ''});
            });
            $('[data-integer]').each(function () {
                $(this).inputmask("integer");
            });
        }
        ;

        if (typeof $.fn.chosen !== 'undefined') {
            $('select[chosen]').each(function () {
                $(this).chosen();
            });
        }

        if (typeof $.fn.datepicker !== 'undefined') {
            $('input[datepicker]').each(function () {
                $(this).datepicker({autoclose: true, format: 'dd/mm/yyyy', language: 'pt-BR'});
            });
        };

        if (typeof $.fn.datetimepicker !== 'undefined') {
            $('input[datetimepicker]').each(function () {
                $(this).datetimepicker({locale: 'pt-BR'});
            });
            $('input[datepicker]').each(function () {
                $(this).datetimepicker({locale: 'pt-BR', format: 'DD/MM/YYYY'});
            });
            $('input[timepicker]').each(function () {
                $(this).datetimepicker({locale: 'pt-BR', format: 'LT'});
            });
            
            
        };
    });
})(window.jQuery);

