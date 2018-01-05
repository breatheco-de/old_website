webpackJsonp([11],{

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

/***/ 6:
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function($) {

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _messaging = __webpack_require__(35);

var _myclabsJquery = __webpack_require__(2);

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

/**
*    Declaration of your module
*    @params modulename and undefined
**/
var bulkbadges = function () {
    function bulkbadges() {
        _classCallCheck(this, bulkbadges);
    }

    _createClass(bulkbadges, [{
        key: 'init',
        value: function init() {
            var _this = this;

            var cohort = this.getParameterByName('cohort');
            if (cohort) document.querySelector('#cohort-id').value = cohort;
            document.querySelector('#cohort-id').addEventListener("change", function (e) {
                if ('URLSearchParams' in window) {
                    var searchParams = new URLSearchParams(window.location.search);
                    searchParams.set("cohort", e.target.value);
                    window.location.search = searchParams.toString();
                }
            });

            document.querySelector('#badge-slug').addEventListener("change", function (e) {
                document.querySelector('#givebadges').classList.remove('hidden');
            });

            var students = document.querySelectorAll('.studentsToAssign li');
            if (students && students.length > 0) Array.from(students).forEach(function (stud) {
                stud.addEventListener('click', function (e) {

                    var currentStudent = e.currentTarget;

                    if (currentStudent.classList.contains('selected')) {
                        if (e.target.tagName !== "INPUT") currentStudent.classList.remove('selected');
                    } else currentStudent.classList.add('selected');
                });
            });

            $('#points').tooltip({ title: "If a number is entered, the system will ignore the points in the list below." });

            $("#givebadges").confirm({
                text: "Are you sure you want to give the badges?",
                title: "Confirmation required",
                confirm: function confirm(button) {
                    _this.givebadges();
                },
                cancel: function cancel(button) {
                    // nothing to do
                },
                confirmButton: "Yes I am",
                cancelButton: "No",
                post: true,
                confirmButtonClass: "btn-danger",
                cancelButtonClass: "btn-default",
                dialogClass: "modal-dialog modal-lg" // Bootstrap classes for large modal
            });
        }
    }, {
        key: 'givebadges',
        value: function givebadges() {
            var list = [];
            var arrayOfPoints = [];
            var cohort = 0;
            $(".studentsToAssign li.selected").each(function () {
                list.push($(this).data('id'));
                arrayOfPoints.push($(this).children('.studentPoints').children().val());
            });

            var points = $('#points').val(); //points: $('#points').val()//send array

            if (points === "") {
                points = arrayOfPoints;
            }

            var thedata = {
                action: 'add_bulk_badges',
                badge: $('#badge-slug').val(),
                students: list,
                points: points
            };
            console.log(thedata);

            $('.inside-content').hide();
            $('.loading').removeClass('hidden');
            this.sendForm(thedata);
        }
    }, {
        key: 'getParameterByName',
        value: function getParameterByName(name, url) {
            if (!url) url = window.location.href;

            name = name.replace(/[\[\]]/g, "\\$&");

            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);

            if (!results) return null;
            if (!results[2]) return '';

            return decodeURIComponent(results[2].replace(/\+/g, " "));
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
                            $('.loading').html('Success! <a href="#" onClick="window.location.reload();">Click here to give more badges</a>');
                        } else {
                            _messaging.BCMessaging.notifyPending(_messaging.BCMessaging.ERROR, response.msg);
                        }
                    }
                }
            });
        }
    }]);

    return bulkbadges;
}();

exports.default = bulkbadges;
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(0)))

/***/ })

});