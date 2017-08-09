/**
 * Jquery File Uploader Pluign is required
 * 
 * @param jQuery $
 * 
 */
+function ($) {
    'use strict';

    $(document).ready(function () {
        $('[data-spell_document]').each(function () {
            $.spell.Document($(this));
        });
    });

    $.spell.Document = function (element) {

        var me = this;
        me.type = 'Document';
        var $element = $(element);
        var strPrefix = String($element.data('prefix'));
        var options = {
            prefix: strPrefix !== 'undefined' ? strPrefix : 'attachment',
            upload: $element.data('upload'),
            readonly: $element.data('readony'),
            load: $element.data('load')
        };

        $element.html($('<div/>').addClass('col-xs-12 attachments')[0]);


        this.uploader = function () {
            var $div = $('<div/>').addClass('col-xs-12 file-uploader');
            var $input = $('<input/>').attr('type', 'file').attr('name', 'spell_document');
            var $spam = $('<span/>').addClass('btn btn-success fileinput-button col-xs-3').html('<i class="fa fa-folder"></i><span></span>').append($input[0]);

            $div.append($spam[0]);
            $div.append('<div class="progress col-xs-9"><div class="progress-bar progress-bar-primary"></div></div>');
            $element.prepend($div);

            me.configUploader();
        };

        this.append = function (data) {
            var $btn = $('<a/>');
            $btn.attr('class', 'btn btn-primary');
            $btn.attr('href', data.src).attr('target', '_blank');
            $btn.html('<i class="fa fa-download"></i> &nbsp;' + data.name);
            $btn.append(me.hidden(data));
            var $rm = $('<a/>').attr('class', 'btn btn-danger').html('<i class="fa fa-times"></i>');
            var $block = $('<span/>').addClass('btn-group');
            $block.append($btn[0]);

            if (!options.readonly)
                $block.append($rm[0]);

            var $attachments = $element.find('.attachments');
            $attachments.append($block[0]);
            $attachments.find('span:last .btn-danger').click(me.removeParent);
        };
        
        $element.data('append', me.append);

        this.removeParent = function (e) {
            e.preventDefault();
            $(this).closest('span').remove();
        };

        this.hidden = function (data) {
            return $('<input/>').attr('type', 'hidden').attr('name', options.prefix + '[]').val(JSON.stringify(data))[0];
        };

        this.done = function (event, json) {
            var $div = $element.find('div.file-uploader').first();
            if (!json.result) {
                console.log('Invalid data format.');
            } else if (typeof json.result.error !== 'undefined') {
                var $box = $('<div/>').addClass('alert alert-error h3').html(json.result.error);
                window.bootbox.alert($box[0].outerHTML);
            } else if (typeof json.result.data.src === 'undefined') {
                window.bootbox.alert('No result');
            } else {
                $element.data('append')(json.result.data);
            }
            $div.find('.progress-bar').css('width', '0px').html('');
        };

        this.configUploader = function () {
            var $file = $element.find(':file');
            $file.fileupload({
                url: options.upload,
                dataType: 'json',
                done: me.done,
                progressall: function (e, data) {
                    var $div = $element.find('div.file-uploader').first();
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $div.find('.progress-bar').css('width', progress + '%').html(progress + '%');
                }
            });
        };

        this.init = function () {
            var jsonString = $(options.load).html();
            var collection = JSON.parse(jsonString);
            $.each(collection, function (k, data) {
                me.append(data);
            });

            if (!options.readonly)
                me.uploader();
        };

        this.init();

        return this;
    };

}(jQuery);