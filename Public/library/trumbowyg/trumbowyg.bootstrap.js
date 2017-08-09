$(document).ready(function () {
    var config = {
        btnsDef: {
            // Customizables dropdowns
            image: {
                //dropdown: ['insertImage', 'upload', 'base64', 'noembed'],
                dropdown: ['insertImage', 'upload'],
                ico: 'insertImage'
            }
        },
        btns: [
            ['viewHTML'],
            ['undo', 'redo'],
            ['formatting'],
            'btnGrp-design',
            ['link'],
            ['image'],
            'btnGrp-justify',
            'btnGrp-lists',
            ['foreColor', 'backColor'],
            ['preformatted'],
            ['horizontalRule'],
            ['fullscreen']
        ]

        ,
        plugins: {
            upload: {
                serverPath: $.spell.UIV().mvc.route.site + $.spell.UIV().mvc.route.module + '/upload-wysiwyg',
                fileFieldName: 'image',
                urlPropertyName: 'data.src'
            }
        }

    };
    $('[data-wysiwyg]').trumbowyg(config);
});