+function ($) {
    'use strict';
    $.spell.ValidatorCheck.cnpj = {};
    $.spell.ValidatorMessages['CNPJ'] = 'CNPJ inválido!';
    
    $.spell.ValidatorCheck.cnpj.error = function ($field) {
        var _cnpj = $field.val();
        
        var cnpj = _cnpj.replace(/[^\d]+/g,'');

        if (cnpj.length < 14) 
            return $.spell.ValidatorMessage('MINLENGTH').replace('{0}', 18);
        
        return $.spell.ValidatorMessage('CNPJ');
    };
    $.spell.ValidatorCheck.cnpj.validate = function($field) {
        var cnpj = $field.val().replace(/[^\d]+/g,'');

        if (cnpj.length < 14)
            return false;
        
        var invalids = [];
        invalids.push('00000000000000');
        invalids.push('11111111111111');
        invalids.push('22222222222222');
        invalids.push('33333333333333');
        invalids.push("44444444444444");
        invalids.push("55555555555555");
        invalids.push("66666666666666");
        invalids.push("77777777777777");
        invalids.push("88888888888888");
        invalids.push("99999999999999");
        
        if(invalids.indexOf(cnpj) > -1)
            return false;

        // Valida DVs
        var tamanho = cnpj.length - 2
        var numeros = cnpj.substring(0,tamanho);
        var digitos = cnpj.substring(tamanho);
        var soma = 0;
        var pos = tamanho - 7;
        for (i = tamanho; i >= 1; i--) {
          soma += numeros.charAt(tamanho - i) * pos--;
          if (pos < 2)
                pos = 9;
        }
        var resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (parseInt(resultado) !== parseInt(digitos.charAt(0)))
            return false;

        tamanho = tamanho + 1;
        numeros = cnpj.substring(0,tamanho);
        soma = 0;
        pos = tamanho - 7;
        var i = null;
        for (i = tamanho; i >= 1; i--) {
          soma += numeros.charAt(tamanho - i) * pos--;
          if (pos < 2)
                pos = 9;
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (parseInt(resultado) !== parseInt(digitos.charAt(1)))
              return false;

        return true;
    };

}(jQuery);