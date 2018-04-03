
+function ($) {
    (typeof $.app === 'undefined' ? $.app = {} : true);
    (typeof $.app.acl === 'undefined' ? $.app.acl = {} : true);
    (typeof $.app.acl.user === 'undefined' ? $.app.acl.user = {} : true);

    $.app.acl.user.contactItemDataModel = function (custom) {
        (typeof custom === 'undefined' ? custom = {} : true);
        var me = this;
        this.id = '';
        this.fkContactMode = '';
        this.vrcContact = '';
        $.each(custom, function (k, value) {
            me[k] = value;
        });
        return this;
    };

    $.app.acl.user.contactItem = function ($element, modeOptions, customData) {
        var me = this;
        var data = new $.app.acl.user.contactItemDataModel(customData);
        var fieldPrefix = '';

        me.fieldId = function () {
            var $id = $('<input/>').attr('type', 'hidden').attr('name', fieldPrefix + '[id]');
            return $id.addClass('field field-id').val(data.id);
        };

        me.fieldVrcContact = function () {
            var $vrcContact = $('<input/>').attr('type', 'text').attr('name', fieldPrefix + '[vrcContact]');
            return $vrcContact.addClass('form-control field field-vrcContact').val(data.vrcContact);
        };

        me.fieldSelectMode = function () {
            var $select = $('<select/>').addClass('form-control field  field-fkContactMode').attr('name', fieldPrefix + '[fkContactMode]');
            $select.append($('<option/>').attr('value', '').html('Selecione o tipo de contato'));
            $.each(modeOptions, function (v, l) {
                $select.append($('<option/>').attr('value', v).html(l));
            });
            $select.val(data.fkContactMode);
            return $select;
        };

        me.btnRemove = function () {
            var $btn = $('<button/>').attr('type', 'button');
            return $btn.addClass('btn btn-remove btn-danger pull-right').append($('<i/>').addClass('fa fa-times'));
        };

        me.remove = function (e) {
            e.preventDefault();
            $(this).closest('div.item').remove();
        };

        me.formGroup = function (cls, $field) {
            return $('<div/>').addClass('form-group ' + cls).append($field).append($('<div/>').addClass('form-error-message'));
        };

        me.guidS4 = function () {
            return Math.floor((1 + Math.random()) * 0x10000)
                    .toString(16)
                    .substring(1);
        };

        me.guid = function () {
            return me.guidS4() + me.guidS4() + me.guidS4() + me.guidS4();
        };

        me.init = function () {
            fieldPrefix = 'contact[' + me.guid() + ']';

            $element.append(me.fieldId());
            $element.append(me.formGroup('col-xs-5', me.fieldSelectMode()));
            $element.append(me.formGroup('col-xs-5', me.fieldVrcContact()));
            $element.append(me.btnRemove());
            $element.find('.btn-remove').click(me.remove);

        };
        me.init();
        return me;
    };

}(jQuery);