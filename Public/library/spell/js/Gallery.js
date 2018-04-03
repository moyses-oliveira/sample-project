/**
 * Jquery File Uploader Pluign is required
 * 
 * @param jQuery $
 * 
 */
+function ($) {
    'use strict';

    $(document).ready(function () {
        $('[data-spell_gallery]').each(function () {
            $.spell.Gallery($(this));
        });
    });

    $.spell.Gallery = function (element) {

        var me = this;
        me.type = 'Gallery';
        var $element = $(element);
        $element.data('spell.Gallery', me);
        var strPrefix = String($element.data('prefix'));
        var options = {
            prefix: strPrefix !== 'undefined' ? strPrefix : 'gallery',
            upload: $element.data('upload'),
            readonly: $element.data('readony'),
            load: $element.data('load')
        };

        $element.html($('<div/>').addClass('col-xs-12 gallery-collection')[0]);


        this.uploader = function () {
            var $div = $('<div/>').addClass('col-xs-12 file-uploader');
            var $input = $('<input/>').attr('type', 'file').attr('name', 'spell_gallery');
            var $spam = $('<span/>').addClass('btn btn-success fileinput-button col-xs-3').html('<i class="fa fa-folder"></i><span></span>').append($input[0]);

            $div.append($spam[0]);
            $div.append('<div class="progress col-xs-9"><div class="progress-bar progress-bar-primary"></div></div>');
            $element.prepend($div);

            me.configUploader();
        };

        this.append = function (data) {

            var $head = $('<div/>').addClass('panel-heading with-border clearfix');

            $head.append($('<h3/>').addClass('panel-title col-xs-8').html(data.name)[0]);

            if (!options.readonly)
                $head.append(me.actionButtons());

            var url = typeof data.url === 'undefined' ? '/' : data.url;
            var png = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=';
            var $img = $('<img/>').attr('src', png);
            $img.css('background-image', 'url(' + url + data.thumb + ')');
            var $a = $('<a/>').addClass('expand col-md-4');
            $a.attr('href', url + data.src).attr('target', '_blank').append($img[0]);
            $a.append(me.dataField(data));
            var $fields = $('<div/>').addClass('col-md-8');
            $fields.append(me.summaryField(data.summary));
            $fields.append(me.orderField());
            $fields.append(me.newField('alt', 'Alt', data.alt));
            $fields.append(me.newField('title', 'Title', data.title));

            var $body = $('<div/>').addClass('panel-body');

            $body.append($a[0]);
            $body.append($fields[0]);

            var $row = $('<div/>').addClass('item-row panel panel-default panel-border');
            $row.append($head[0]);
            $row.append($body[0]);

            var $collection = $element.find('.gallery-collection');
            $collection.append($row[0]);
            var $last = $collection.find('div.item-row:last');
            $last.find('.remove').click(me.removeParent);
            $last.find('.move-before').click(me.moveBefore);
            $last.find('.move-after').click(me.moveAfter);
            //$last.find('.expand').click(me.expand);
            var keyUid = me.uid();
            $last.find('input.gallery-field').each(function () {
                var rename = $(this).attr('name').replace('{k}', keyUid);
                $(this).attr('name', rename);
            });
            me.actionButtonsTrigger();
        };

        $element.data('append', me.append);

        this.actionButtonsTrigger = function () {
            var $rows = $element.find('.gallery-collection div.item-row');
            var order = 0;
            $rows.each(function () {
                var $row = $(this);
                $row.find('.move-before, .move-after').removeClass('hide');
                if ($row.is(':first-child'))
                    $row.find('.move-before').addClass('hide');

                if ($row.is(':last-child'))
                    $row.find('.move-after').addClass('hide');

                $row.find('input.order').val(order);
                order++;
            });
        };


        this.actionButtons = function () {
            var $div = $('<div/>').addClass('pull-right');
            $div.append(me.buttonRemove);
            $div.append(me.buttonMove('before', 'fa-arrow-up'));
            $div.append(me.buttonMove('after', 'fa-arrow-down'));
            return $div[0];
        };

        this.buttonRemove = function () {
            var $a = $('<a/>').addClass('btn btn-danger btn-xs pull-right remove');
            $a.attr('href', '#').html('<i class="fa fa-times"></i>');
            return $a[0];
        };

        this.buttonMove = function (direction, icon) {
            var $a = $('<a/>').addClass('btn btn-primary btn-xs pull-right move-' + direction);
            $a.attr('href', '#').html('<i class="fa ' + icon + '"></i>');
            return $a[0];
        };

        this.newField = function (name, label, value) {
            var $field = $('<div/>').addClass('form-group');
            var $input = $('<input/>').attr('type', 'text').attr('maxlength', 256);
            $input.addClass('form-control gallery-field');
            $input.attr('name', options.prefix + '[{k}][' + name + ']');
            $input.attr('placeholder', label).val(value);
            $field.append($('<label/>').html(label)[0]);
            $field.append($input[0]);
            return $field[0];
        };

        this.dataField = function (data) {
            var $input = $('<input/>').attr('type', 'hidden').attr('name', options.prefix + '[{k}][data]');
            $input.addClass('gallery-field').val(JSON.stringify(data));
            return $input[0];
        };

        this.summaryField = function (value) {
            var $input = $('<input/>').attr('type', 'hidden').attr('name', options.prefix + '[{k}][summary]');
            $input.addClass('gallery-field').val(value);
            return $input[0];
        };

        this.orderField = function () {
            var $input = $('<input/>').attr('type', 'hidden').attr('name', options.prefix + '[{k}][order]');
            return $input.addClass('gallery-field order')[0];
        };

        this.expand = function (e) {
            e.preventDefault();
            var $img = $('<img/>').attr('src', $(this).attr('href')).addClass('img-responsive');
            window.bootbox.alert({message: $img[0].outerHTML, size: 'large'});
        };

        this.removeParent = function (e) {
            e.preventDefault();
            $(this).closest('.item-row').remove();
            me.actionButtonsTrigger();
        };

        this.moveBefore = function (e) {
            e.preventDefault();
            var $row = $(this).closest('.item-row');
            var i = $row.index();
            var $collection = $element.find('.gallery-collection .item-row');
            var subject = $($collection.get(i));
            subject.insertBefore($collection.get(i - 1));
            me.actionButtonsTrigger();
        };

        this.moveAfter = function (e) {
            e.preventDefault();
            var $row = $(this).closest('.item-row');
            var i = $row.index();
            var $collection = $element.find('.gallery-collection .item-row');
            var subject = $($collection.get(i));
            subject.insertAfter($collection.get(i + 1));
            me.actionButtonsTrigger();
        };

        this.swap = function (i, j) {
        };


        this.done = function (event, json) {
            var $div = $element.find('div.file-uploader').first();
            if (!json.result) {
                console.log('Invalid data format.');
            } else if (typeof json.result.error !== 'undefined') {
                var $box = $('<div/>').addClass('alert alert-error h3').html(json.result.error[0]);
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
                error: function (jqXHR) {
                    var $div = $element.find('div.file-uploader').first();
                    var json = JSON.parse(jqXHR.responseText);
                    var $box = $('<div/>').addClass('alert alert-error h3').html(json.error[0]);
                    window.bootbox.alert($box[0].outerHTML);
                    $div.find('.progress-bar').css('width', '0px').html('');
                },
                progressall: function (e, data) {
                    var $div = $element.find('div.file-uploader').first();
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $div.find('.progress-bar').css('width', progress + '%').html(progress + '%');
                }
            });
        };

        this.uid4 = function () {
            return Math.floor((1 + Math.random()) * 0x10000)
                    .toString(16)
                    .substring(1);
        };

        this.uid = function () {
            var str = '';
            for (var i = 0; i < 8; i++)
                str += me.uid4();
            return str;
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