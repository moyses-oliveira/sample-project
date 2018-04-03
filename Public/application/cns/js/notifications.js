
+function ($) {
    if (typeof $.app === 'undefined')
        $.app = {};

    if (typeof $.app.cns === 'undefined')
        $.app.cns = {};

    $.app.cns.el = function (tag, htmlClass, attributes) {

        var $el = $('<' + tag + '/>');

        if (typeof attributes !== 'object')
            attributes = {};

        if (typeof htmlClass === 'string')
            $el.addClass(htmlClass);

        $.each(attributes, function (k, v) {
            $el.attr(k, v);
        });
        return $el;
    };

    $.app.cns.urgentNotifications = function () {
        var me = this;

        me.$counter = $('.navbar-custom-menu a[data-type=info]>span');
        me.messages = [];
        me.length = 0;
        me.count = 0;
        me.el = $.app.cns.el;
        me.idMessage = null;

        me.getRoot = function () {
            return $.spell.UIV().mvc.route.root;
        };

        me.confirm = function (isConfirm) {
            if (!isConfirm)
                return;

            var url = me.getRoot() + 'cns/info/accept-message/' + me.idMessage;
            $.getJSON(url, function (json) {
                var count = me.$counter.html();
                if (json.success)
                    me.$counter.html(parseInt(count) - 1);

                if (me.count !== me.length)
                    me.showMessage();
            });
        };


        me.showUrgentMessages = function (data) {
            if (!data.length)
                return;

            me.messages = data;
            me.length = data.length;
            me.showMessage();
        };

        me.showMessage = function () {
            me.count++;
            var data = me.messages.shift();
            me.idMessage = data.id;
            var $title = me.el('div', 'row');
            $title.append(me.el('div', 'h5 col-xs-4 text-primary').html(data.summary));
            $title.append(me.el('div', 'h5 col-xs-4 text-center').html(data.from));
            $title.append(me.el('div', 'h5 col-xs-4 text-danger text-right').html(data.posted));
            var $description = me.el('div', 'row').append(me.el('div', 'col-xs-12').html(data.description));

            var $hr = $('<hr/>').attr('style', 'margin: 7px;');
            var $page = me.el('div', 'row').append(me.el('div', 'col-xs-12 text-right').html('Mensagem ' + me.count + ' de ' + me.length));
            var $content = me.el('div').append($title).append($description);

            var avancar = $('<i/>').addClass('fa fa-arrow-right')[0].outerHTML + ' &nbsp; Avançar';
            var confirmLabel = me.count === me.length ? 'Concluir' : avancar;

            var option = {
                title: $('<i/>').addClass('fa fa-warning')[0].outerHTML + ' &nbsp; Atenção',
                message: $content[0].outerHTML,
                size: 'large',
                callback: me.confirm,
                closeButton: false,
                buttons: {
                    confirm: {
                        label: confirmLabel
                    }
                }
            };
            window.bootbox.confirm(option);
            $('.modal-dialog .modal-footer').attr('style', 'padding-top: 15px;').append($hr).append($page);
            $('.modal-dialog .modal-footer [data-bb-handler=cancel]').hide();
        };

        me.loadUrgentMessages = function () {
            var url = me.getRoot() + 'cns/info/load-urgent-messages';
            $.getJSON(url, me.showUrgentMessages);
        };

        me.loadUrgentMessages();
    };


    $.app.cns.notifications = function (element, custom) {
        var $element = $(element).first();
        var $counter = $element.find('.dropdown-toggle>span');
        var $menu = $element.find('ul.menu');

        var defaultOptions = {
        };

        var me = this;
        me.options = $.extend(defaultOptions, custom);

        me.el = $.app.cns.el;

        me.getRoot = function () {
            return $.spell.UIV().mvc.route.root;
        };

        me.appendNotification = function (data, isTask) {
            if (typeof isTask === 'undefined')
                isTask = false;

            var actionUrl = isTask ? data.url : '#';
            var $div = me.el('div', 'pull-left');
            var $icon = (
                    typeof data.fromIcon !== 'undefined' ?
                    me.el('img', 'img-circle', {'alt': data.from, 'src': data.fromIcon}) :
                    me.el('i', 'fa fa-desktop', {'style': 'font-size: 30px;margin-top: 7px;'})
                    );
            $div.append($icon[0]);

            var $h4 = me.el('h4');
            var clockIcon = me.el('i', 'fa fa-clock-o')[0].outerHTML;
            var $clock = me.el('small').html(clockIcon + ' &nbsp' + data.posted);
            $h4.html(data.from);

            var $a = me.el('a', null, {href: actionUrl});
            $a.append($clock).append($div).append($h4).append(me.el('p').html(data.summary));
            var $li = me.el('li').append($a);

            $menu.append($li);
            var $item = $menu.find('li').last();
            var $itemButton = $item.find('a');
            $itemButton.data('data', data);

            if (!isTask)
                $itemButton.click(me.itemClick);
        };

        me.confirm = function (isConfirm) {
            if (!isConfirm)
                return;

            var url = me.getRoot() + 'cns/info/accept-message/' + me.idMessage;
            $.getJSON(url, function (json) {
                var count = $counter.html();
                if (json.success)
                    $counter.html(parseInt(count) - 1);
            });
        };

        me.itemClick = function (e) {
            e.preventDefault();
            var data = $(this).data('data');
            me.idMessage = data.id;
            var option = {
                title: data.summary,
                message: data.description,
                size: 'large',
                callback: me.confirm
            };
            window.bootbox.confirm(option);
        };

        me.showBsDropDown = function (event) {
            var $a = $(this).find('a.dropdown-toggle');
            var url = $a.attr('href');
            $menu.html('');
            $.getJSON(url, function (json) {
                var count = json.length;
                $.each(json, function (k, data) {
                    me.appendNotification(data, $a.data('type') === 'task');
                });
                $element.find('li.header').html('You have ' + count + ' messages.');
                $counter.html(count);
            });
        };

        $element.on("show.bs.dropdown", me.showBsDropDown);
    };

    $(document).ready(function () {
        $('.dropdown.messages-menu').each(function () {
            new $.app.cns.notifications(this);
        });
        $('ul.dropdown-menu ul.menu')
                .slimscroll({height: '200px', alwaysVisible: false, size: '3px'})
                .css("width", "100%");

        $.app.cns.urgentNotifications();
    });


}(jQuery);
