
+function ($) {
    if (typeof $.app === 'undefined')
        $.app = {};

    if (typeof $.app.cns === 'undefined')
        $.app.cns = {};

    $.app.cns.groupSelector = function (element) {
        var $element = $(element).first();
        var me = this;
        me.groupRel = $.spell.UIV().groupRel;
        $element.on('change', function () {
            var fkGroup = $(this).val();
            var $users = $('.checkbox-group .user-checkbox');
            $users.removeProp('checked').removeAttr('checked');
            
            if(fkGroup === 'all') {
                $users.prop('checked', true).attr('checked', true);
                return;
            }
            
            if (typeof  me.groupRel[fkGroup] === 'undefined')
                return;

            var users = me.groupRel[fkGroup];
            $.each(users, function (k, fkUser) {
                $.each($users, function (j, el) {
                    var $user = $(el);
                    if(parseInt($user.val()) === parseInt(fkUser))
                        $user.prop('checked', true).attr('checked', true);
                });
            });

        });

    };

    $(document).ready(function () {
        new $.app.cns.groupSelector('[cns-form-group-selector]');
    });


}(jQuery);