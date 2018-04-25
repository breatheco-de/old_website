webpackJsonp([4],{

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

/***/ }),

/***/ 9:
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
var UserCohort = function () {
    function UserCohort() {
        _classCallCheck(this, UserCohort);
    }

    _createClass(UserCohort, [{
        key: 'init',
        value: function init() {
            var _this = this;

            document.querySelector('#modal-update_profile .send-btn').addEventListener("click", function (btn) {
                var firstname = $('#firstname').val();
                var lastname = $('#lastname').val();
                var github = $('#github').val();
                var phonenumber = $('#phonenumber').val();
                var bio = $('#bio').val();
                /*
                if(!validator.isURL(github) || github.length==0) BCMessaging.addMessage(BCMessaging.ERROR,'The github URL must be a valid URL');
                
                let messages = BCMessaging.getMessages(BCMessaging.ERROR);
                if(messages.length>0) BCMessaging.notifyPending(BCMessaging.ERROR);
                else this.deliverAssignment(assignmentId,github);
                */
                _this.sendForm({
                    action: 'update_profile',
                    firstname: firstname,
                    lastname: lastname,
                    github: github,
                    phonenumber: phonenumber,
                    bio: bio
                });
            });
            document.querySelector('#modal-update_settings .send-btn').addEventListener("click", function (btn) {
                var formElements = document.querySelectorAll('#modal-update_settings form .settings');

                var settings = {};
                for (var i = 0; i < formElements.length; i++) {
                    settings[formElements[i].name] = formElements[i].checked;
                }
                console.log(settings);
                /*
                if(!validator.isURL(github) || github.length==0) BCMessaging.addMessage(BCMessaging.ERROR,'The github URL must be a valid URL');
                
                let messages = BCMessaging.getMessages(BCMessaging.ERROR);
                if(messages.length>0) BCMessaging.notifyPending(BCMessaging.ERROR);
                else this.deliverAssignment(assignmentId,github);
                */
                _this.sendForm({
                    action: 'update_settings',
                    settings: settings
                });
            });

            _badges.BadgesManager.init('.badg-img');
        }
    }, {
        key: 'sendForm',
        value: function sendForm(thedata) {

            $.ajax({
                url: WPAS_APP.ajax_url,
                method: 'post',
                dataType: "json",
                data: thedata,
                success: function success(response) {
                    if (response) {
                        if (response.code == '200') {
                            window.location.reload();
                        } else {
                            _messaging.BCMessaging.notifyPending(_messaging.BCMessaging.ERROR, response.msg);
                        }
                    }
                }
            });
        }
    }, {
        key: 'refreshBadges',
        value: function refreshBadges(badgesData) {
            var badgesLi = document.querySelectorAll('.talent-badge li');
            console.log(badgesLi);
            badgesLi.forEach(function (auxBadge) {
                var badge = badgesData.find(function (item) {
                    if (item.slug == auxBadge.getAttribute('data-slug')) return auxBadge;
                });
                var childs = auxBadge.childNodes;
                childs.forEach(function (elm) {
                    console.log(elm);
                    //if the badge has a real URL
                    if (elm.classList && badge.url && badge.url != '' && elm.classList.contains('avatar')) elm.style.backgroundUrl = "url('" + badge.url + "')";

                    //If the badge has a name
                    if (elm.classList && badge.name && badge.name != '' && elm.classList.contains('badge-name')) elm.innerHTML = badge.name;
                });
            });
        }
    }]);

    return UserCohort;
}();

exports.default = UserCohort;
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(0)))

/***/ })

});