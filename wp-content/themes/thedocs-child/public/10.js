webpackJsonp([10],{

/***/ 10:
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function($) {

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _messaging = __webpack_require__(35);

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

/**
*    Declaration of your module
*    @params modulename and undefined
**/
var project = function () {
    function project() {
        _classCallCheck(this, project);

        //any properties here using this.propertyName
        $('#content1').css('display', 'block');
        $(".github-tabs").click(function () {
            $(this).parent().siblings().css('display', 'none');
            $(this).parent().siblings('#' + $(this).attr('for')).css("display", "block");
        });
    }

    _createClass(project, [{
        key: 'init',
        value: function init() {}
    }]);

    return project;
}();

exports.default = project;
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(0)))

/***/ }),

/***/ 35:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});
var BCMessaging = exports.BCMessaging = function () {

    var _public = {};
    _public.ERROR = 'danger';
    _public.WARNING = 'warning';
    _public.SUCCESS = 'success';
    var notificationContainer = null;

    var messages = [];

    _public.addMessage = function (type, message) {

        if (typeof messages[type] == 'undefined') messages[type] = [];
        messages[type].push(message);
    };

    _public.getMessages = function (type) {

        if (typeof messages[type] == 'undefined') messages[type] = [];
        return messages[type];
    };

    _public.notify = function (type, message) {

        showNotification('top', {
            type: type,
            message: message
        });
    };

    _public.notifyPending = function (type) {
        var messagesArray = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;


        var content = '<ul>';
        if (!messagesArray) messages[type].forEach(function (msg) {
            content += '<li>' + msg + '</li>';
        });else messagesArray.forEach(function (msg) {
            content += '<li>' + msg + '</li>';
        });
        content += '</ul>';

        messages[type] = [];

        showNotification('top', {
            type: type,
            message: content
        });
    };

    function showNotification(position, notification) {
        if (!notificationContainer) createNotificationContainer(position);

        appendNotification(notification);
    }

    function appendNotification(notification) {

        var singleNotification = document.createElement('div');
        singleNotification.classList.add('single-notification');
        singleNotification.innerHTML = getTemplate()(notification.type, notification.message);

        notificationContainer.appendChild(singleNotification);

        var nodeChilds = singleNotification.childNodes;
        for (var i = 0; i < nodeChilds.length; i++) {
            if (nodeChilds[i].className == "close") {
                nodeChilds[i].addEventListener('click', function () {
                    notificationContainer.removeChild(singleNotification);
                });
                break;
            }
        }

        setTimeout(function () {
            singleNotification.classList.add('about-to-close');
            setTimeout(function () {
                notificationContainer.removeChild(singleNotification);
                if (notificationContainer.childNodes.length == 0) deleteNotificationContainer();
            }, 500);
        }, 3000);
    }

    function createNotificationContainer(position) {

        notificationContainer = document.createElement('div');
        notificationContainer.classList.add('bcnotification');
        notificationContainer.classList.add(position + '-notification');
        document.body.appendChild(notificationContainer);
    }

    function deleteNotificationContainer() {
        if (notificationContainer) {
            notificationContainer.parentNode.removeChild(notificationContainer);
            notificationContainer = null;
        }
    }

    function getTemplate() {
        return function (type, message) {
            return '<div class="inner-message alert alert-' + type + '">\n                                    <button type="button" class="close" data-dismiss="alert">&times;</button>\n                                    ' + message + '\n                                </div>';
        };
    }

    return _public;
}();

/***/ })

});