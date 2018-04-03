+function ($) {
    'use strict';
    $.spell.ValidatorCheck.password_confirm = {};
    $.spell.ValidatorMessages['INVALID_PASSWORD'] = 'Senha incorreta.';
    $.spell.ValidatorMessages['CONFIRM'] = "Senha não confere.";
    $.spell.ValidatorCheck.password_confirm.error = function ($field) {
        return $.spell.ValidatorMessage('CONFIRM');
    };
    $.spell.ValidatorCheck.password_confirm.validate = function ($field) {
        var $c = $($field.data('password_confirm'));
        $c.closest('form').data('$.spell.Validator').fieldCheck($c);
        return $c.val() === $field.val();
    };

}(jQuery);