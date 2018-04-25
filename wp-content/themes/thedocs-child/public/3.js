webpackJsonp([3],{

/***/ 12:
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function($) {

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _messaging = __webpack_require__(35);

var _badges = __webpack_require__(51);

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

/**
*    Declaration of your module
*    @params modulename and undefined
**/
var quiz = function () {
    function quiz() {
        //any properties here using this.propertyName

        _classCallCheck(this, quiz);
    }

    _createClass(quiz, [{
        key: 'init',
        value: function init() {
            var _this = this;

            _badges.BadgesManager.init('.badg-img');

            window.addEventListener('message', function (event) {

                // IMPORTANT: Check the origin of the data! 
                if (~event.origin.indexOf('https://assets.breatheco.de')) {
                    // The data has been sent from your site 
                    var studentId = document.querySelector('#student').value;
                    var quizId = document.querySelector('#quiz').value;
                    var badges = document.querySelectorAll('.single-badge');

                    if (event.data.started) {
                        _this.sendForm({ action: 'save_attempt', student: studentId, quiz: quizId }, function () {
                            console.log('Quiz attempt successfully saved.');
                        });
                    } else {
                        var percentage = Math.floor(event.data.passedQuestions / event.data.totalQuestions * 100);
                        if (percentage > 75) {
                            badges.forEach(function (badgeElm) {

                                var badgeId = badgeElm.getAttribute("data-slug");
                                var points = badgeElm.getAttribute("data-points");

                                this.sendForm({
                                    action: 'give_points',
                                    badge: badgeId,
                                    student: studentId,
                                    points: points
                                }, function () {

                                    _messaging.BCMessaging.notify(_messaging.BCMessaging.SUCCESS, "Poins for " + badgeId + " given successfully.");
                                    window.location.reload();
                                });
                            });
                        }
                    }
                    // The data sent with postMessage is stored in event.data 
                } else {
                    // The data hasn't been sent from your site! 
                    // Be careful! Do not use it. 
                    return;
                }
            });
        }
    }, {
        key: 'sendForm',
        value: function sendForm(thedata) {
            var _success = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;

            // the_ajax_script.ajaxurl is a variable that will contain the url to the ajax processing file
            $.ajax({
                url: WPAS_APP.ajax_url,
                method: 'post',
                dataType: "json",
                data: thedata,
                success: function success(response) {
                    if (response) {
                        if (response.code == '200') {
                            if (_success) _success();
                        } else {
                            _messaging.BCMessaging.notifyPending(_messaging.BCMessaging.ERROR, response.msg);
                        }
                    }
                }
            });
        }
    }]);

    return quiz;
}();

exports.default = quiz;
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

/***/ }),

/***/ 51:
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function($) {

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.BadgesManager = undefined;

var _messaging = __webpack_require__(35);

var BadgesManager = exports.BadgesManager = function () {

    var publicScope = {};
    var _badges = [];
    var _badgesClass = '';
    var _cancelHide = false;
    var _cancelShow = false;
    var _loading = false;

    publicScope.init = function (badgesClass) {

        _badgesClass = badgesClass;

        document.querySelectorAll(_badgesClass).forEach(function (elm) {
            elm.addEventListener("mouseenter", function (evt) {
                return getPopoverContent(evt);
            });
            elm.addEventListener("mouseout", function (evt) {
                return hidePopover(evt);
            });
        });
    };

    function hidePopover(e) {
        _cancelHide = false;
        if (_loading) _cancelShow = true;
        document.querySelectorAll(_badgesClass).forEach(function (elm) {
            if (!_cancelHide) $(elm.parentNode).popover('hide');
        });
    }

    function getPopoverContent(e) {
        //console.log(e);
        _cancelHide = true;
        var badgeArrray = _badges;
        var badgeId = $(e.target).data('slug');
        if (typeof badgeId === 'undefined') return;

        if (typeof badgeArrray[badgeId] !== 'undefined') {

            document.querySelectorAll(_badgesClass).forEach(function (elm) {
                if (elm == e.target) {
                    $(e.target.parentNode).popover('show');
                } else $(elm.parentNode).popover('hide');
            });
            return badgeArrray[badgeId];
        } else {
            badgeArrray[badgeId] = { description: 'Loading...' };
            _loading = true;

            $(e.target.parentNode).popover({
                placement: function placement(context, source) {
                    var position = cumulativeOffset(e.target);

                    if (position.left > 515) {
                        return "left";
                    }

                    if (position.left < 515) {
                        return "right";
                    }

                    if (position.top < 110) {
                        return "bottom";
                    }

                    return "top";
                },
                content: function content() {
                    return badgeArrray[badgeId].description;
                }
            }).popover('show');

            $.ajax({
                url: WPAS_APP.ajax_url,
                method: 'GET',
                data: { action: 'get_badge', badge: badgeId },
                success: function success(response) {
                    _loading = false;

                    if (response.code == 200) {
                        badgeArrray[badgeId] = response.data;
                        document.querySelectorAll(_badgesClass).forEach(function (elm) {
                            if (elm == e.target) {
                                if (_cancelShow) _cancelShow = false;else $(e.target.parentNode).popover('show');
                            } else $(elm.parentNode).popover('hide');
                        });
                    } else _messaging.BCMessaging.notify(_messaging.BCMessaging.ERROR, response.msg);
                }
            });
        }
    }

    function cumulativeOffset(element) {
        var top = 0,
            left = 0;
        do {
            top += element.offsetTop || 0;
            left += element.offsetLeft || 0;
            element = element.offsetParent;
        } while (element);

        return {
            top: top,
            left: left
        };
    };

    return publicScope;
}();
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(0)))

/***/ })

});