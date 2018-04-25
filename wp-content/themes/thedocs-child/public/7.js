webpackJsonp([7],{

/***/ 16:
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
var UserCohort = function () {
	function UserCohort() {
		_classCallCheck(this, UserCohort);
	}

	_createClass(UserCohort, [{
		key: 'init',
		value: function init() {
			var _this = this;

			document.querySelector('#slack-url').addEventListener('focusout', function (evt) {

				var slackURL = evt.target.value;
				var cohort = evt.target.getAttribute("data-cohort");

				var thedata = {
					action: 'save_slack_url',
					cohort_id: cohort,
					slack: slackURL
				};

				_this.sendForm(thedata, function (obj) {
					$(evt.target).closest('.input-group').append('<span class="glyphicon glyphicon-ok inside" style="color:green;"></span>');
					_messaging.BCMessaging.notify(_messaging.BCMessaging.SUCCESS, "The Slack URL was updated sucessfully.");
					setTimeout(function () {

						var validCheck = document.querySelector('.input-group .glyphicon.inside');
						validCheck.parentNode.removeChild(validCheck);
					}, 2000);
				});
			});

			document.querySelector('#class_attendancy .send-btn').addEventListener("click", function (btn) {
				var list = {};
				var cohort = 0;
				$(".attendants").each(function () {
					if ($(this).prop('checked')) list[$(this).val()] = $('#student' + $(this).val()).val();else list[$(this).val()] = false;

					cohort = $(this).data('cohort');
				});

				_this.sendAttendancy(cohort, list);
			});

			document.querySelector('#update_repls .send-btn').addEventListener("click", function (btn) {
				var repls = {};
				var cohort = 0;
				$("#update_repls input").each(function (elm) {
					repls[$(this).attr('id')] = $(this).val();
					cohort = $(this).data('cohort');
				});

				_this.updateReplits(cohort, repls);
			});
		}
	}, {
		key: 'sendAttendancy',
		value: function sendAttendancy(cohort, list) {

			var thedata = {
				action: 'check_attendancy',
				cohort_id: cohort,
				attendants: list
			};

			this.sendForm(thedata);

			return false;
		}
	}, {
		key: 'updateReplits',
		value: function updateReplits(cohort, replits) {
			var thedata = {
				action: 'update_replits',
				repls: replits,
				cohort_id: cohort
			};
			// the_ajax_script.ajaxurl is a variable that will contain the url to the ajax processing file
			this.sendForm(thedata);

			return false;
		}
	}, {
		key: 'sendForm',
		value: function sendForm(thedata) {
			var successCallback = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;

			$.ajax({
				url: WPAS_APP.ajax_url,
				data: thedata,
				method: 'POST',
				success: function success(response) {
					if (response) {
						if (response.code == '200') {
							if (!successCallback) window.location.reload();else successCallback();
						} else {
							_messaging.BCMessaging.notify(_messaging.BCMessaging.ERROR, response.msg);
						}
					}
				}
			});
		}
	}]);

	return UserCohort;
}();

exports.default = UserCohort;
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