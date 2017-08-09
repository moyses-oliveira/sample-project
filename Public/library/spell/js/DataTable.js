+function ($) {
    'use strict';
    
    if (typeof $.spell === 'undefined')
        $.spell = {};

    $(document).ready(function () {
        $('[data-spell_data_table]').each(function(){
            $.spell.DataTable($(this));
        });
    });

    $.spell.DataTable = function ($element) {
        var me = this;

        this.rowConfig = function (nRow, rowData, iDisplayIndex, iDisplayIndexFull) {
            $('td', nRow).find('a.confirm_delete').click(function (e) {
                me.confirmDelete(this, e, rowData);
            });
            $('td', nRow).find('a.confirm_redirect').click(function (e) {
                me.confirmRedirect(this, e, rowData);
            });
        };

        this.columnConfig = function (columns) {
            var dttb_columns = [];
            $.each(columns, function (k, column) {
                if (typeof column.actions !== 'undefined') {
                    column.mRender = function (id, type, rowData) {
                        return me.actionBtns(column.actions, rowData);
                    };
                }
                dttb_columns.push(column);
            });
            return dttb_columns;
        };

        this.buttonConfig = function (element, buttons) {
            $.each(buttons, function (k, btn) {
                var button = {tag: 'a', href: btn.url, class: 'btn btn-sm btn-primary pull-right', content: btn.content};
                element.prepend($.spell.HTML(button));
            });
        };

        this.actionBtns = function (actions, data) {
            var actionButtons = [];

            $.each(actions, function (key, action) {
                if (!!action.activeParam && !data[action.activeParam])
                    return;

                var button = {
                    tag: 'a',
                    href: action.url,
                    title: action.title,
                    class: 'btn ' + action.cls,
                    content: [{tag: 'i', class: 'fa fa-' + action.icon}]
                };

                if (action.mode === 'confirm')
                    button.confirm = action.confirm;

                actionButtons.push(button);
            });

            if (actionButtons.length < 1)
                return '';

            var mainDivHTML = $.spell.HTML(actionButtons);

            return me.render(mainDivHTML, data);
        };

        this.normalize = function (str) {
            return str.replace(new RegExp('"', 'gi'), '&quot;');
        };

        this.render = function (str, data) {
            $.each(data, function (key, value) {
                str = str.replace(new RegExp("\\{" + key + "\\}", 'gi'), value);
            });
            return str;
        };

        this.confirmDelete = function (element, e, rowData) {
            e.preventDefault();
            var confirmUrl = me.render($(element).attr('href'), rowData);
            var msg = me.render($(element).attr('confirm'), rowData);
            msg = $.spell.HTML({tag: 'h3', content: me.normalize(msg), class: 'text-center'});
            var table = $(element).closest('table');
            window.bootbox.confirm(msg, function (result) {
                if (!result)
                    return;

                $.getJSON(confirmUrl, function (data) {
                    if (!data.success)
                        return;

                    table.DataTable().ajax.reload(function () {}, false);
                });
            });
        };

        this.confirmRedirect = function (element, e, rowData) {
            e.preventDefault();
            var confirmUrl = me.render($(element).attr('href'), rowData);
            var msg = me.render($(element).attr('confirm'), rowData);
            msg = $.spell.HTML({tag: 'h3', content: me.normalize(msg), class: 'text-center'});
            window.bootbox.confirm(msg, function (result) {
                if (result)
                    window.location.href = confirmUrl;
            });
        };

        this.config = function (dataUrl, columns, lang) {
            return	{
                processing: true,
                serverSide: true,
                ajax: dataUrl,
                aoColumns: columns,
                language: {url: lang},
                fnRowCallback: me.rowConfig
            };
        };

        this.init = function () {
            var jsonConf = $element.attr('app-config');
            if (!$(jsonConf).length)
                throw "config can't be found!";

            var config = JSON.parse($(jsonConf).html());
            var dataUrl = config.dataUrl;

            var dttb_columns = me.columnConfig(config.columns);

            var dataTableConf = me.config(dataUrl, dttb_columns, config.language);

            var parent = $element;
            var $table = parent.find('table.data').first();

            $table.DataTable(dataTableConf);

            me.buttonConfig(parent.find('.navbar-header'), config.buttons);

            $element.data('$.spell.DataTable', me);
        };
        
        me.init();

    };

}(jQuery);



