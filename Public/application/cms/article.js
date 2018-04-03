$(document).ready(function () {
    var $element = $('#cover-image');
    var $file = $element.find(':file');
    var endPoint = $element.data('endpoint');
    var root = $.spell.UIV().mvc.route.root;
    var $unsetImg = $element.find('.unset-image');
    $file.fileupload({
        url: endPoint,
        dataType: 'json',
        send: function (event, data) {
            $('body').faLoading();
        },
        done: function (event, json) {
            if (!json.result) {
                console.log('Invalid data format.');
            } else if (typeof json.result.error !== 'undefined') {
                var $box = $('<div/>').addClass('alert alert-error h3').html(json.result.error[0]);
                window.bootbox.alert($box[0].outerHTML);
            } else if (typeof json.result.data.src === 'undefined') {
                window.bootbox.alert('No result');
            } else {
                $element.find('[name=vrcImageSrc]').val(root + json.result.data.src);
                $element.find('img').css('background-image', 'url(' + root + json.result.data.src + ')');
                $unsetImg.show();
            }
            // $div.find('.progress-bar').css('width', '0px').html('');
        },
        error: function (jqXHR) {
            var $div = $element.find('div.file-uploader').first();
            var json = JSON.parse(jqXHR.responseText);
            var $box = $('<div/>').addClass('alert alert-error h3').html(json.error[0]);
            window.bootbox.alert($box[0].outerHTML);
            //$div.find('.progress-bar').css('width', '0px').html('');
        },
        progressall: function (e, data) {
            //var $div = $element.find('div.file-uploader').first();
            //var progress = parseInt(data.loaded / data.total * 100, 10);
            //$div.find('.progress-bar').css('width', progress + '%').html(progress + '%');
        },
        always: function (e, data) {
            $('body').faLoading();
        }
    });
    $unsetImg.toggle($element.find('[name=empty]').val() === 'false');

    $unsetImg.click(function (e) {
        e.preventDefault();
        var noImg = $(this).data('default');
        $element.find('img').css('background-image', 'url(' + noImg + ')');
        $element.find('[name=vrcImageSrc]').val(noImg);
        $(this).hide();
    });
});