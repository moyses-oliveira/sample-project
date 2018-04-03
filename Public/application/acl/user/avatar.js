$(document).ready(function () {
    var $element = $('#avatar');
    var $file = $element.find(':file');
    var endPoint = $element.data('endpoint');
    var root = $.spell.UIV().mvc.route.root;
    $file.fileupload({
        url: endPoint,
        dataType: 'json',
        done: function (event, json) {
            if (!json.result) {
                console.log('Invalid data format.');
            } else if (typeof json.result.error !== 'undefined') {
                var $box = $('<div/>').addClass('alert alert-error h3').html(json.result.error[0]);
                window.bootbox.alert($box[0].outerHTML);
            } else if (typeof json.result.data.src === 'undefined') {
                window.bootbox.alert('No result');
            } else {
                $element.find('[name=vrcImage]').val(root + json.result.data.src);
                $element.find('img').css('background-image', 'url(' + root + json.result.data.src  + ')');
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
        }
    });
});

