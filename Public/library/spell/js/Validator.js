+function ($) {
    'use strict';

    if (typeof $.spell === 'undefined')
        $.spell = {};

    $(document).ready(function () {
        $('form[data-spell_validator]').each(function(){
            $.spell.Validator(this);
        });
    });

    $.spell.Validator = function (element) {
        var me = this;
        var $element = $(element);
        $element.data('$.spell.Validator', me);

        me.fields = function () {
            return $element.find(':input:not([type="submit"], [type="reset"], button)');
        };

        /**
         * 
         * @returns {Boolean}
         */
        me.validate = function () {
            var errorCount = 0;
            me.fields().each(function () {
                errorCount += me.fieldCheck($(this)) ? 0 : 1;
            });
            return errorCount < 1;
        };

        /**
         * 
         * @returns {Array}
         */
        me.errors = function () {
            var results = [];
            me.clearFields();
            me.fields().each(function () {
                var $field = $(this);
                me.fieldCheck($field);
                if (!$field.data('error'))
                    return true;

                results.push($field.data('error'));
            });
            return results;
        };


        /**
         * 
         * @param {jQuery} $field
         * @returns {Boolean}
         */
        me.fieldCheck = function ($field) {
            me.fieldShowError($field, false);
            $.each($.spell.ValidatorCheck, function (k, check) {
                if ((['native']).indexOf(k) < 0 && typeof $field.data(k) === 'undefined')
                    return true;

                if (check.validate($field))
                    return true;

                me.fieldShowError($field, check.error($field));
                return false;
            });
            return !$field.data('error');
        };

        /**
         * 
         * @param {EventListener} e
         */
        me.fieldCheckTrigger = function (e) {
            me.fieldCheck($(this));
        };

        /**
         * 
         */
        me.clearFields = function () {
            me.fields().each(function () {
                var $field = $(this);
                me.fieldShowError($field, false);
            });
            return;
        };

        /**
         * 
         * @param {jQuery} $field
         * @param {string} error
         * @returns {Boolean}
         */
        me.fieldShowError = function ($field, error) {
            var $group = $field.closest('.form-group');
            $field.data('error', error);
            $group.removeClass('has-error');
            if (!$group.length)
                return false;

            var errorMessage = $group.find('.form-error-message');
            if (!errorMessage.length)
                return false;

            if (error)
                $group.addClass('has-error');

            errorMessage.html(error);
            return false;
        };

        /**
         * 
         * @param {eventListener} e
         * @returns {void}
         */
        me.submit = function (e) {
            e.preventDefault();
            if (me.validate())
                me.send();
            else
                me.errors();
        };
        me.getUIV = function () {
            if (typeof $.spell.UIV === 'undefined')
                return {};

            return $.spell.UIV();
        };
        me.showErrors = function (errors) {
            var uiv = me.getUIV();


            $.each(errors, function (k, error) {
                var $gem = $element.find('.global-form-warnings');
                var $field = $element.find('[name="' + k + '"]');
                
                if (k === 'GLOBAL') {
                    $element.find('.global-form-warnings')
                            .removeClass('hide').find('p').html(error);
                }
                me.fieldShowError($field, $.spell.ValidatorMessage(error));
            });
        };

        me.send = function () {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: $element.attr('action'),
                data: $element.serializeArray(),
                success: function (data) {
                    me.clearFields();
                    if (!data.success)
                        return me.showErrors(data.errors);

                    if (typeof data.redirect !== 'undefined')
                        window.location.href = data.redirect;

                },
                error: function (x, s, e) {
                    console.log(e, x, s);
                }
            });
        };

        me.fieldConfig = function ($field) {
            if ($field.prop('required'))
                $field.removeAttr('required').data('required', true);

            var isInput = $field.prop('tagName') === 'INPUT';
            var isTextarea = $field.prop('tagName') === 'TEXTAREA';
            var nonText = ['radio', 'checkbox', 'file', 'button', 'submit', 'reset', 'hidden'];
            var isTextInput = isInput && (nonText).indexOf($field.attr('type')) < 0;

            if (isTextInput || isTextarea)
                $field.keyup(me.fieldCheckTrigger);
            else
                $field.change(me.fieldCheckTrigger);

            $field.blur(me.fieldCheckTrigger);
        };

        me.init = function () {
            me.fields().each(function () {
                me.fieldConfig($(this));
            });
            $element.submit(me.submit);
        };

        me.init();
    };

    $.spell.ValidatorMessages = {
        DEFAULT: 'Este campo é obrigatório.',
        REQUIRED: 'Este campo é obrigatório.',
        INVALID: 'O valor deste campo é invalido.',
        REPEATED: 'Já existe um registro com este valor.',
        ALIAS: 'Apenas letras, numeros e os simbolos (-, _) são válidos.',
        EMAIL: 'Este campo aceita apenas e-mails no formato nome@dominio .',
        MINLENGTH: 'Este campo deve conter no mínimo {0} caracteres.'
    };

    $.spell.ValidatorMessage = function (errorKey) {
        var keys = Object.keys($.spell.ValidatorMessages);
        if (keys.indexOf(errorKey) < 0)
            errorKey = 'DEFAULT';

        return $.spell.ValidatorMessages[errorKey];
    };

    $.spell.ValidatorCheck = {};

    $.spell.ValidatorCheck.required = {
        error: function ($field) {
            return $.spell.ValidatorMessage('REQUIRED');
        },
        validate: function ($field) {
            var val = $field.val();
            return val !== null && val.length > 0;
        }
    };

    $.spell.ValidatorCheck.native = {
        error: function ($field) {
            return $.spell.ValidatorMessage('INVALID');
        },
        validate: function ($field) {
            var el = $field[0];
            var test = el.checkValidity && el.checkValidity() && el.validity.valid;
            if (test)
                return true;

            return false;
        }
    };

    $.spell.ValidatorCheck.minlength = {
        error: function ($field) {
            var minlength = $field.data('minlength');
            return $.spell.ValidatorMessage('MINLENGTH').replace('{0}', minlength);
        },
        validate: function ($field) {
            var minlength = $field.data('minlength');
            return $field.val().length >= minlength;
        }
    };

}(jQuery);