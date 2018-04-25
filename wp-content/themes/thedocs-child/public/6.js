webpackJsonp([6],{

/***/ 4:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _search = __webpack_require__(52);

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

/**
*    Declaration of your module
*    @params modulename and undefined
**/
var assets = function () {
    function assets() {
        //any properties here using this.propertyName

        _classCallCheck(this, assets);
    }

    _createClass(assets, [{
        key: 'init',
        value: function init() {
            _search.BCSearch.init('assets');
        }
    }]);

    return assets;
}();

exports.default = assets;

/***/ }),

/***/ 52:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});
var BCSearch = exports.BCSearch = function () {

    var _public = {};
    var searchInput, searchMode, postType;
    var listening = false;

    _public.init = function (mode) {
        searchInput = document.querySelector(".search-top-bar .search-box");
        searchInput.addEventListener('focus', startListeningSearch);
        changeMode(mode);

        var radios = document.querySelectorAll('.search-mode .btn');
        radios.forEach(function (elm) {
            elm.addEventListener('click', function (e) {
                changeMode(this.childNodes[1].value); //get the radio button (is always the second child)
            });
        });
    };

    function startListeningSearch(e) {

        if (!listening) searchInput.addEventListener('keypress', function (e) {
            if (e.keyCode == 13) {
                if (searchInput.value != '') window.location = '/?s=' + searchInput.value + '&post_type=' + getPostType(searchMode);
            }
        });
        listening = true;
    }

    function changeMode(mode) {
        searchMode = mode;
        document.querySelector('.search-mode input[type=radio]').classList.remove('active');
        var activeBtn = document.querySelector('.search-mode input[value=' + mode + '] ');
        activeBtn.parentNode.classList.add('active');
        searchInput.placeholder = 'Search ' + mode;
    }

    function getPostType(mode) {
        switch (mode) {
            case 'lessons':
                return 'lesson';
                break;
            case 'assets':
                return 'lesson-asset';
                break;
            default:
                return '';
                break;
        }
    }

    return _public;
}();

/***/ })

});