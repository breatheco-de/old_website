webpackJsonp([9],{

/***/ 11:
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
var projects = function () {
    function projects() {
        _classCallCheck(this, projects);

        //any properties here using this.propertyName
        this.projects = [];
        this.getProjects();
    }

    _createClass(projects, [{
        key: 'init',
        value: function init() {}
    }, {
        key: 'getProjects',
        value: function getProjects() {
            var _this = this;

            var thedata = {
                action: 'get_projects'
            };
            // the_ajax_script.ajaxurl is a variable that will contain the url to the ajax processing file
            $.ajax({
                url: WPAS_APP.ajax_url,
                method: 'post',
                dataType: "json",
                data: thedata,
                success: function success(response) {
                    if (response) {
                        if (response.code == '200') {
                            _this.renderProjects(response.data);
                        } else {
                            _messaging.BCMessaging.notify(_messaging.BCMessaging.ERROR, response.msg);
                        }
                    }
                }
            });
        }
    }, {
        key: 'renderProjects',
        value: function renderProjects(projects) {

            var list = document.querySelector('.projects ul');
            list.innerHTML = "";
            for (var i = 0; i < projects.length; i++) {
                list.innerHTML += this.renderSingleProject(projects[i]);
            }
        }
    }, {
        key: 'renderSingleProject',
        value: function renderSingleProject(project) {
            return '<li class="single-project">\n            <div class="row push-right">\n                <div class="col-xs-9 col-md-10">\n                    <h5>' + project.title + '</h5>\n                    <p>' + project.excerpt + '</p>\n                    <strong>Takes ' + project.duration + ' hours, focused in ' + this.getLabels(project.technologies) + '</strong>\n                </div>\n                <div class="col-xs-3 col-md-2 assignment-bar">\n                    <a href="/project?slug=' + project.project_slug + '" class="btn btn-primary">view</a>\n                </div>\n            </div>\n        </li>';
        }
    }, {
        key: 'getLabels',
        value: function getLabels(labelString) {
            var labels = labelString.split(',');
            return labels.map(function (label) {
                return '<span class="label label-default">' + label + '</span>';
            }).join(' ');
        }
    }]);

    return projects;
}();

exports.default = projects;
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