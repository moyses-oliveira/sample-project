
+function ($) {
    (typeof $.app === 'undefined' ? $.app = {} : true);
    (typeof $.app.acl === 'undefined' ? $.app.acl = {} : true);
    (typeof $.app.acl.user === 'undefined' ? $.app.acl.user = {} : true);


    $.app.acl.user.contact = function (element, config) {
        var $element = $(element).first();
        var me = this;
        var _setting = {};
        var collection = $element.data('collection');
        var modeOptions = $element.data('mode-options');
        var $collection = null;
        me.setting = $.extend(_setting, config);
        me.setting.collection = !collection ? [] : collection; 
        

        me.newContact = function(e) {
            e.preventDefault();
            me.add({});
        };
        
        me.add = function(data) {
            (typeof data === 'undefined' ? data = false: true);
            $('<div/>').addClass('item').appendTo($collection);
            var $item = $collection.find('>div.item').last();
            $.app.acl.user.contactItem($item, modeOptions, data);
        };

        me.init = function () {
            var $heading = $('<div/>').addClass('panel-heading').append($('<h3/>').addClass('panel-title').html('Contato'));

            var $body = $('<div/>').addClass('panel-body clearfix');

            var $footer = $('<div/>').addClass('panel-footer');
            var btnAddLabel = '<i class="fa fa-plus"></i> &nbsp; Novo Contato';
            $footer.append($('<a/>').attr('href', '#').addClass('btn btn-block btn-primary btn-new-contact').html(btnAddLabel));
            var $panel = $('<div/>').addClass('panel panel-color panel-info');
            $panel.append($heading).append($body).append($footer).appendTo($element);
            $collection = $element.find('.panel-body');
            $element.find('.btn-new-contact').click(me.newContact);
            
            $.each(collection, function(k, data) {
                me.add({id: data.id, fkContactMode: data.fkContactMode, vrcContact: data.vrcContact});
            });
        };
        
        me.init();

        return me;
    };
    
    

    $(document).ready(function () {
        $.app.acl.user.contact('[data-acl-user-contact]');
    });


}(jQuery);

