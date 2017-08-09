
+function ($) {
    if (typeof $.app === 'undefined')
        $.app = {};

    if (typeof $.app.cns === 'undefined')
        $.app.cns = {};

    $.app.cns.notifications = function (element, custom) {
        var $element = $(element).first();
        var $menu = $element.find('ul.dropdown-menu ul.menu');
        var $counter = $element.find('.dropdown-toggle>span');
        var defaultOptions = {
        };

        var me = this;
        me.options = $.extend(defaultOptions, custom);

        me.el = function (tag, htmlClass, attributes) {
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

        me.getRoot = function () {
            return $.spell.UIV().mvc.route.root;
        };

        me.appendNotification = function (data) {
            var $div = me.el('div', 'pull-left');
            var $icon = (
                    typeof data.fromIcon !== 'undefined' ?
                    me.el('img', 'img-circle', {'alt': data.from, 'src': data.fromIcon}) :
                    me.el('i', 'fa fa-desktop', {'style': 'font-size: 30px;margin-top: 7px;'})
                    );
            $div.append($icon[0]);

            var $h4 = me.el('h4');
            var clockIcon = me.el('i', 'fa fa-clock-o')[0].outerHTML;
            var clock = me.el('small').html(clockIcon + ' &nbsp' + data.posted)[0].outerHTML;
            $h4.html(data.from + clock);

            var $a = me.el('a', null, {href: '#'});
            $a.append($div[0]).append($h4[0]).append(me.el('p').html(data.summary)[0]);
            var $li = me.el('li').append($a[0]);

            $menu.append($li[0]);

            var $item = $menu.find('li').last();
            var $itemButton = $item.find('a');
            $itemButton.data('data', data);
            $itemButton.click(me.itemClick);
        };

        me.confirm = function () {
            var url = me.getRoot() + 'cns/info/accept-message/' + me.idMessage;
            $.getJSON(url, function (json) {
                var count = $counter.html();
                if(json.success)
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

        $element.on("show.bs.dropdown", function (event) {
            $menu.html('');
            $.getJSON(me.getRoot() + 'cns/info/load-messages', function (json) {
                var count = json.length;
                $.each(json, function (k, data) {
                    me.appendNotification(data);
                });
                $element.find('li.header').html('You have ' + count + ' messages.');
                $counter.html(count);
            });
        });
    };

    $(document).ready(function () {
        $.app.cns.notifications('.dropdown.messages-menu');
        $('ul.dropdown-menu ul.menu')
                .slimscroll({height: '200px', alwaysVisible: false, size: '3px'})
                .css("width", "100%");
    });


}(jQuery);
