/*
 * jQuery SNS Share Plugin
 *
 * @author sj
 * @link https://github.com/samejack/SnsShare
 * @copyright Copyright 2014 SJ
 * @version 1.0.0
 * @license Apache License Version 2.0 (https://github.com/samejack/SnsShare/blob/master/LICENSE)
 */
jQuery.fn.snsShare = function(message, url) {

    var getAtagElement, makeMouseClickEvent, types;

    /**
     * Get ths a tag singleton
     * @returns {HTMLElement}
     */
    getAtagElement = function () {
        var element = document.getElementById('share-a-tag');
        if (element === null) {
            element = document.createElement('a');
            element.style = "display: none;";
            element.id = 'share-a-tag';
            element.target = "_blank";
            document.getElementsByTagName('body')[0].appendChild(element);
        }
        return element;
    };

    /**
     * Create a mouse click event
     * @returns {Event}
     */
    makeMouseClickEvent = function () {
        var clickEvent = document.createEvent('MouseEvents');
        clickEvent.initMouseEvent('click', true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
        return clickEvent;
    };

    /**
     * Implement SNS types
     * @type {string[]}
     */
    types = ['facebook', 'google+', 'line', 'linkedin', 'twitter', 'plurk'];

    // fix URL
    if (typeof(url) === 'undefined') {
        url = window.location;
    }

    return this.each(function () {
        jQuery(this).click(function (e) {
			e.preventDefault();
            var element, snsType = jQuery(this).attr('data-sns'), protocol;
            if (typeof(snsType) === 'string' && jQuery.inArray(snsType, types) !== -1) {
                if (typeof(message) === 'undefined') {
                    message = window.location;
                }
                protocol = location.protocol;
				var shareURL = '#';
                switch (snsType) {
                    case 'facebook':
                        shareURL = protocol + '//www.facebook.com/sharer.php?u=' + url + '&t=' + encodeURIComponent(message);
                        break;
                    case 'google+':
                        shareURL = protocol + '//plus.google.com/share?url=' + encodeURIComponent(url);
                        break;
                    case 'linkedin':
                        shareURL = protocol + '//www.linkedin.com/cws/share?url=' + url + '&title=' + encodeURIComponent(message);
                        break;
                    case 'line':
                        shareURL = protocol + '//line.naver.jp/R/msg/text/?' + encodeURIComponent(message + ' ' + url);
                        break;
                    case 'twitter':
                        shareURL = protocol + '//twitter.com/home/?status=' + encodeURIComponent(message + ' ' + url);
                        break;
                    case 'plurk':
                        shareURL = protocol + '//www.plurk.com/m?qualifier=shares&content=' + encodeURIComponent(message + ' ' + url);
                        break;
                    default:
                        alert('SNS type not found. (' + options + ')');
                }
				window.open(shareURL, 'shareWindow', 'height=450, width=550, top=' + ($(window).height() / 2 - 275) + ', left=' + ($(window).width() / 2 - 225) + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
            } else {
                alert('data-sns attribute not set.');
            }
        });
    });
};
