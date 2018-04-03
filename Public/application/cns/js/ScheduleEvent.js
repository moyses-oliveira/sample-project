
+function ($) {
    if (typeof $.app === 'undefined')
        $.app = {};

    if (typeof $.app.cns === 'undefined')
        $.app.cns = {};

    $.app.cns.ScheduleEvent = function (element) {
        var me = this;
        var $element = $(element).first();
        me.$category = function() {
            return $element.closest('.card-box').find('[name=fkCategory]');
        };
        me.dataSrc = $element.data('src');
        
        me.init = function() {
        
            var route = $.spell.UIV().mvc.route;
            $element.fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listWeek'
                },
                editable: false,
                navLinks: true, // can click day/week names to navigate views
                eventLimit: true, // allow "more" link when too many events
                events: {
                    url: me.dataSrc,
                    error: function () {
                        $('#script-warning').show();
                    }
                },
                loading: function (bool) {
                    $('#loading').toggle(bool);
                },
                eventRender: function eventRender(event, element, view) {
                    var fkCategory = me.$category().val();
                    if (!fkCategory)
                        return true;

                    return parseInt(event.fkCategory) === parseInt(fkCategory);
                }
            });
	
            me.$category().on('change',function(){
                $element.fullCalendar('rerenderEvents');
            });
        };
        
        me.init();
    };

    $(document).ready(function () {
        $('[data-schedule-event]').each(function () {
            new $.app.cns.ScheduleEvent(this);
        });
    });


}(jQuery);