+function ($) {
    'use strict';
    $.spell.ValidatorCheck.cpf = {};
    $.spell.ValidatorMessages['CPF'] = "CPF inválido";
    $.spell.ValidatorCheck.cpf.error = function ($field) {     
        var strCPF = $field.val().replace(/[^\d]+/g,'');
        if (strCPF.length < 11)
            return $.spell.ValidatorMessage('MINLENGTH').replace('{0}', 14);
        
        return $.spell.ValidatorMessage('CPF');
    };
    $.spell.ValidatorCheck.cpf.validate = function ($field) {        
        var strCPF = $field.val().replace(/[^\d]+/g,'');
        if (strCPF.length < 11)
            return false;
        
        var Soma;
        var Resto;
        var i;
        Soma = 0;
        if (strCPF === "00000000000")
            return false;

        for (i = 1; i <= 9; i++)
            Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
        Resto = parseInt((Soma * 10) % 11);

        if (([10, 11]).indexOf(Resto) > -1)
            Resto = 0;

        if (Resto !== parseInt(strCPF.substring(9, 10)))
            return false;

        Soma = 0;
        for (i = 1; i <= 10; i++)
            Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);

        Resto = (Soma * 10) % 11;

        if (([10, 11]).indexOf(Resto) > -1)
            Resto = 0;

        if (Resto !== parseInt(strCPF.substring(10, 11)))
            return false;

        return true;
    };

}(jQuery);