webpackJsonp([12],{

/***/ 5:
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function($) {

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

/**
*    Declaration of your module
*    @params modulename and undefined
**/
var bclogin = function () {
    function bclogin() {
        _classCallCheck(this, bclogin);

        this.errorAlert = '.alert-danger';
    }

    _createClass(bclogin, [{
        key: 'init',
        value: function init() {
            var _this = this;

            document.querySelector(".form-signin").addEventListener('submit', function (e) {
                e.preventDefault();

                if (_this.validateLogin()) _this.login();

                return false;
            });
        }
    }, {
        key: 'validateLogin',
        value: function validateLogin() {
            var userVal = document.querySelector('#username').value;
            var passVal = document.querySelector('#password').value;

            if (userVal && passVal) return true;
        }
    }, {
        key: 'login',
        value: function login() {
            var userVal = document.querySelector('#username').value;
            var passVal = document.querySelector('#password').value;

            this.send(userVal, passVal);
        }
    }, {
        key: 'showError',
        value: function showError(msg) {
            var errorContainer = document.querySelector(this.errorAlert);
            errorContainer.innerHTML = msg;
            errorContainer.style.display = 'block';

            var loginBtn = document.querySelector('#login');
            loginBtn.disabled = false;
            loginBtn.innerHTML = 'Sign In';
            loginBtn.classList.add('btn-primary');
        }
    }, {
        key: 'hideError',
        value: function hideError() {
            var errorContainer = document.querySelector(this.errorAlert);
            errorContainer.innerHTML = '';
            errorContainer.style.display = 'none';

            var loginBtn = document.querySelector('#login');
            loginBtn.disabled = false;
            loginBtn.innerHTML = 'Loading...';
            loginBtn.classList.remove('btn-primary');
        }
    }, {
        key: 'send',
        value: function send(userVal, passVal) {
            var _this2 = this;

            this.hideError();

            var thedata = {
                action: 'custom_login',
                username: userVal,
                password: passVal
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
                            window.location.href = response.data;
                        } else {
                            _this2.showError(response.msg);
                        }
                    }
                }
            });

            return false;
        }
    }]);

    return bclogin;
}();

exports.default = bclogin;
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(0)))

/***/ })

});