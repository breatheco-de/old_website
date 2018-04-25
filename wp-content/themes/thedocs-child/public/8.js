webpackJsonp([8],{

/***/ 13:
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
var ReviewAssignments = function () {
	function ReviewAssignments() {
		_classCallCheck(this, ReviewAssignments);
	}

	_createClass(ReviewAssignments, [{
		key: 'init',
		value: function init() {
			var _this = this;

			document.querySelector('#modal_new-assignment .send-btn').addEventListener("click", function (btn) {
				var cohortId = $('#cohort').val();
				var templateId = $('#atemplate-select').val();
				var duedate = $('#duedate').val();
				_this.createAsignment(cohortId, duedate, templateId);
			});

			var acceptButtons = document.querySelectorAll('.assignments .btn-success');
			if (acceptButtons && acceptButtons.length > 0) Array.from(acceptButtons).forEach(function (btn) {
				btn.addEventListener('click', function (e) {
					var thedata = {
						action: 'get_assignment_earnings',
						slug: e.target.getAttribute('data-slug')
					};

					document.querySelector('#assignment-id').value = e.target.getAttribute('data-assignment');
					document.querySelector('#student-name').value = e.target.getAttribute('data-student');
					var accptButton = document.querySelector('#modal-accept_assignment .send-btn');

					$.ajax({
						url: WPAS_APP.ajax_url,
						data: thedata,
						success: function success(response) {
							if (response.code == 500) {
								_messaging.BCMessaging.notify(_messaging.BCMessaging.ERROR, response.msg);
								document.querySelector('.project-earnings').innerHTML = '';
								accptButton.classList.add("hidden");
							} else {
								var project = response.data;
								var content = _this.printProjectEarnings(project);
								document.querySelector('.project-earnings').innerHTML = content;
								document.querySelector('#assignment-title').value = project.title;
								accptButton.classList.remove("hidden");
							}
						}
					});
				});
			});
			document.querySelector('#modal-accept_assignment .send-btn').addEventListener("click", function (btn) {

				//let inputs = document.forms.acceptassignment;
				//var myControls = inputs.elements['badge[]'];
				var assignment = document.querySelector("#assignment-id").value;
				var inputs = document.querySelectorAll("input[name*='badge']");
				var badges = {};
				inputs.forEach(function (input) {
					badges[input.getAttribute('data-key')] = input.value;
				});

				_this.acceptAsignment(badges, assignment);
			});

			var rejectButtons = document.querySelectorAll('.assignments .btn-danger');
			if (rejectButtons && rejectButtons.length > 0) Array.from(rejectButtons).forEach(function (btn) {
				btn.addEventListener('click', function (e) {
					document.querySelector('#assignment-id').value = e.target.getAttribute('data-assignment');
					var rjButton = document.querySelector('#modal-reject_assignment .send-btn');
					rjButton.classList.remove("hidden");
				});
			});
			document.querySelector('#modal-reject_assignment .send-btn').addEventListener("click", function (btn) {

				//let inputs = document.forms.acceptassignment;
				//var myControls = inputs.elements['badge[]'];
				var assignmentId = document.querySelector("#assignment-id").value;
				var reason = document.querySelector("#reject_reason").value;
				_this.rejectAssignment(assignmentId, reason);
			});
		}
	}, {
		key: 'send',
		value: function send(assignmentId) {

			var thedata = {
				action: 'deliver_project',
				assignment: assignmentId
			};
			// the_ajax_script.ajaxurl is a variable that will contain the url to the ajax processing file
			$.ajax({
				url: WPAS_APP.ajax_url,
				method: 'post',
				dataType: "json",
				data: thedata,
				success: function success(response) {
					if (response) {
						if (response.code == '200') window.location.reload();else _messaging.BCMessaging.notify(_messaging.BCMessaging.ERROR, response.msg);
					} else _messaging.BCMessaging.notify(_messaging.BCMessaging.ERROR, "The was an unexpected error");
				}
			});

			return false;
		}
	}, {
		key: 'createAsignment',
		value: function createAsignment(cohortId, duedate, templateId) {

			var thedata = {
				action: 'create_new_assignment',
				cohort_id: cohortId,
				duedate: duedate,
				template_id: templateId
			};
			// the_ajax_script.ajaxurl is a variable that will contain the url to the ajax processing file
			$.ajax({
				url: WPAS_APP.ajax_url,
				method: 'post',
				dataType: "json",
				data: thedata,
				success: function success(response) {
					if (response) {
						if (response.code == '200') window.location.reload();else _messaging.BCMessaging.notify(_messaging.BCMessaging.ERROR, response.msg);
					} else _messaging.BCMessaging.notify(_messaging.BCMessaging.ERROR, "The was an unexpected error");
				}
			});

			return false;
		}
	}, {
		key: 'acceptAsignment',
		value: function acceptAsignment(badges, assignmentId) {

			var thedata = {
				action: 'accept_assignment',
				assignment_id: assignmentId,
				points: badges
			};
			// the_ajax_script.ajaxurl is a variable that will contain the url to the ajax processing file
			$.ajax({
				url: WPAS_APP.ajax_url,
				method: 'post',
				dataType: "json",
				data: thedata,
				success: function success(response) {
					console.log(response);
					if (response) {
						if (response.code == '200') window.location.reload();else _messaging.BCMessaging.notify(_messaging.BCMessaging.ERROR, response.msg);
					} else _messaging.BCMessaging.notify(_messaging.BCMessaging.ERROR, "The was an unexpected error");
				}
			});

			return false;
		}
	}, {
		key: 'rejectAssignment',
		value: function rejectAssignment(assignmentId, reason) {

			var thedata = {
				action: 'reject_assignment',
				assignment_id: assignmentId,
				reject_reason: reason
			};
			// the_ajax_script.ajaxurl is a variable that will contain the url to the ajax processing file
			$.ajax({
				url: WPAS_APP.ajax_url,
				method: 'post',
				dataType: "json",
				data: thedata,
				success: function success(response) {
					console.log(response);
					if (response) {
						if (response.code == '200') window.location.reload();else _messaging.BCMessaging.notify(_messaging.BCMessaging.ERROR, response.msg);
					} else _messaging.BCMessaging.notify(_messaging.BCMessaging.ERROR, "The was an unexpected error");
				}
			});

			return false;
		}
	}, {
		key: 'printProjectEarnings',
		value: function printProjectEarnings(project) {
			var content = '';
			project.talents.forEach(function (talent) {
				content += '<div class="input-group">\n\t\t\t\t            <span class="input-group-addon">' + talent.badge + '</span>\n\t\t\t\t\t\t    <input max=\'' + talent.points + '\' min=\'0\' data-key="' + talent.badge + '" class="form-control talent-input" required="required" type="number" name=\'badge[]\' value=\'' + talent.points + '\'>\n\t\t\t\t        </div>';
			});
			return content;
		}
	}]);

	return ReviewAssignments;
}();

exports.default = ReviewAssignments;
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