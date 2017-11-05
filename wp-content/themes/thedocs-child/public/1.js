webpackJsonp([1],[/* 0 */
,/* 1 */
,/* 2 */
,/* 3 */
,/* 4 */
,/* 5 */
,/* 6 */
,/* 7 */
,/* 8 */
/***/
function(e,t,r){"use strict";/* WEBPACK VAR INJECTION */
(function(e){Object.defineProperty(t,"__esModule",{value:true});var u=function(){function e(e,t){for(var r=0;r<t.length;r++){var u=t[r];u.enumerable=u.enumerable||false;u.configurable=true;if("value"in u)u.writable=true;Object.defineProperty(e,u.key,u)}}return function(t,r,u){if(r)e(t.prototype,r);if(u)e(t,u);return t}}();var a=r(53);var n=o(a);var l=r(35);function o(e){return e&&e.__esModule?e:{default:e}}function i(e,t){if(!(e instanceof t)){throw new TypeError("Cannot call a class as a function")}}/**
*    Declaration of your module
*    @params modulename and undefined
**/
var f=function(){function t(){i(this,t)}u(t,[{key:"init",value:function t(){var r=this;var u=document.querySelectorAll(".deliver-assignment");u.forEach(function(e){e.addEventListener("click",function(e){e.preventDefault();var t=e.target.getAttribute("data-assignment");var r=e.target.getAttribute("data-assignment-title");document.querySelector("#assignment-title").value=r;document.querySelector("#assignment").value=t;return false})});document.querySelector("#modal-deliver_assignment .send-btn").addEventListener("click",function(t){var u=e("#assignment").val();var a=e("#github").val();var o=n.default.isURL(a);if(!o||a.length==0)l.BCMessaging.addMessage(l.BCMessaging.ERROR,"The github URL must be a valid URL");var i=l.BCMessaging.getMessages(l.BCMessaging.ERROR);if(i.length>0)l.BCMessaging.notifyPending(l.BCMessaging.ERROR);else r.deliverAssignment(u,a)})}},{key:"deliverAssignment",value:function t(r,u){var a={action:"deliver_project",assignment:r,github:u};
// the_ajax_script.ajaxurl is a variable that will contain the url to the ajax processing file
e.ajax({url:WPAS_APP.ajax_url,method:"post",dataType:"json",data:a,success:function e(t){if(t){if(t.code=="200"){window.location.reload()}else{l.BCMessaging.notify(l.BCMessaging.ERROR,t.msg)}}}})}}]);return t}();t.default=f}).call(t,r(0))},/* 9 */
,/* 10 */
,/* 11 */
,/* 12 */
,/* 13 */
,/* 14 */
,/* 15 */
,/* 16 */
,/* 17 */
,/* 18 */
,/* 19 */
,/* 20 */
,/* 21 */
,/* 22 */
,/* 23 */
,/* 24 */
,/* 25 */
,/* 26 */
,/* 27 */
,/* 28 */
,/* 29 */
,/* 30 */
,/* 31 */
,/* 32 */
,/* 33 */
,/* 34 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=u;function u(e){var t=typeof e==="string"||e instanceof String;if(!t){throw new TypeError("This library (validator.js) validates strings only")}}e.exports=t["default"]},/* 35 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});var u=t.BCMessaging=function(){var e={};e.ERROR="danger";e.WARNING="warning";e.SUCCESS="success";var t=null;var r=[];e.addMessage=function(e,t){if(typeof r[e]=="undefined")r[e]=[];r[e].push(t)};e.getMessages=function(e){if(typeof r[e]=="undefined")r[e]=[];return r[e]};e.notify=function(e,t){u("top",{type:e,message:t})};e.notifyPending=function(e){var t=arguments.length>1&&arguments[1]!==undefined?arguments[1]:null;var a="<ul>";if(!t)r[e].forEach(function(e){a+="<li>"+e+"</li>"});else t.forEach(function(e){a+="<li>"+e+"</li>"});a+="</ul>";r[e]=[];u("top",{type:e,message:a})};function u(e,r){if(!t)n(e);a(r)}function a(e){var r=document.createElement("div");r.classList.add("single-notification");r.innerHTML=o()(e.type,e.message);t.appendChild(r);var u=r.childNodes;for(var a=0;a<u.length;a++){if(u[a].className=="close"){u[a].addEventListener("click",function(){t.removeChild(r)});break}}setTimeout(function(){r.classList.add("about-to-close");setTimeout(function(){t.removeChild(r);if(t.childNodes.length==0)l()},500)},3e3)}function n(e){t=document.createElement("div");t.classList.add("bcnotification");t.classList.add(e+"-notification");document.body.appendChild(t)}function l(){if(t){t.parentNode.removeChild(t);t=null}}function o(){return function(e,t){return'<div class="inner-message alert alert-'+e+'">\n                                    <button type="button" class="close" data-dismiss="alert">&times;</button>\n                                    '+t+"\n                                </div>"}}return e}()},/* 36 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=u;function u(){var e=arguments.length>0&&arguments[0]!==undefined?arguments[0]:{};var t=arguments[1];for(var r in t){if(typeof e[r]==="undefined"){e[r]=t[r]}}return e}e.exports=t["default"]},/* 37 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=l;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}function l(e){(0,a.default)(e);e=Date.parse(e);return!isNaN(e)?new Date(e):null}e.exports=t["default"]},/* 38 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});var u=typeof Symbol==="function"&&typeof Symbol.iterator==="symbol"?function(e){return typeof e}:function(e){return e&&typeof Symbol==="function"&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e};t.default=a;function a(e){if((typeof e==="undefined"?"undefined":u(e))==="object"&&e!==null){if(typeof e.toString==="function"){e=e.toString()}else{e="[object Object]"}}else if(e===null||typeof e==="undefined"||isNaN(e)&&!e.length){e=""}return String(e)}e.exports=t["default"]},/* 39 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=f;var u=r(34);var a=o(u);var n=r(36);var l=o(n);function o(e){return e&&e.__esModule?e:{default:e}}var i={require_tld:true,allow_underscores:false,allow_trailing_dot:false};function f(e,t){(0,a.default)(e);t=(0,l.default)(t,i);/* Remove the optional trailing dot before checking validity */
if(t.allow_trailing_dot&&e[e.length-1]==="."){e=e.substring(0,e.length-1)}var r=e.split(".");if(t.require_tld){var u=r.pop();if(!r.length||!/^([a-z\u00a1-\uffff]{2,}|xn[a-z0-9-]{2,})$/i.test(u)){return false}
// disallow spaces
if(/[\s\u2002-\u200B\u202F\u205F\u3000\uFEFF\uDB40\uDC20]/.test(u)){return false}}for(var n,o=0;o<r.length;o++){n=r[o];if(t.allow_underscores){n=n.replace(/_/g,"")}if(!/^[a-z\u00a1-\uffff0-9-]+$/i.test(n)){return false}
// disallow full-width chars
if(/[\uff01-\uff5e]/.test(n)){return false}if(n[0]==="-"||n[n.length-1]==="-"){return false}}return true}e.exports=t["default"]},/* 40 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=l;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}function l(e){(0,a.default)(e);return parseFloat(e)}e.exports=t["default"]},/* 41 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=y;var u=r(34);var a=d(u);var n=r(36);var l=d(n);var o=r(42);var i=d(o);var f=r(39);var s=d(f);function d(e){return e&&e.__esModule?e:{default:e}}var c={allow_display_name:false,require_display_name:false,allow_utf8_local_part:true,require_tld:true};/* eslint-disable max-len */
/* eslint-disable no-control-regex */
var v=/^[a-z\d!#\$%&'\*\+\-\/=\?\^_`{\|}~\.\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+[a-z\d!#\$%&'\*\+\-\/=\?\^_`{\|}~\.\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF\s]*<(.+)>$/i;var _=/^[a-z\d!#\$%&'\*\+\-\/=\?\^_`{\|}~]+$/i;var p=/^([\s\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e]|(\\[\x01-\x09\x0b\x0c\x0d-\x7f]))*$/i;var g=/^[a-z\d!#\$%&'\*\+\-\/=\?\^_`{\|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+$/i;var m=/^([\s\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|(\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*$/i;/* eslint-enable max-len */
/* eslint-enable no-control-regex */
function y(e,t){(0,a.default)(e);t=(0,l.default)(t,c);if(t.require_display_name||t.allow_display_name){var r=e.match(v);if(r){e=r[1]}else if(t.require_display_name){return false}}var u=e.split("@");var n=u.pop();var o=u.join("@");var f=n.toLowerCase();if(f==="gmail.com"||f==="googlemail.com"){o=o.replace(/\./g,"").toLowerCase()}if(!(0,i.default)(o,{max:64})||!(0,i.default)(n,{max:254})){return false}if(!(0,s.default)(n,{require_tld:t.require_tld})){return false}if(o[0]==='"'){o=o.slice(1,o.length-1);return t.allow_utf8_local_part?m.test(o):p.test(o)}var d=t.allow_utf8_local_part?g:_;var y=o.split(".");for(var h=0;h<y.length;h++){if(!d.test(y[h])){return false}}return true}e.exports=t["default"]},/* 42 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});var u=typeof Symbol==="function"&&typeof Symbol.iterator==="symbol"?function(e){return typeof e}:function(e){return e&&typeof Symbol==="function"&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e};t.default=o;var a=r(34);var n=l(a);function l(e){return e&&e.__esModule?e:{default:e}}/* eslint-disable prefer-rest-params */
function o(e,t){(0,n.default)(e);var r=void 0;var a=void 0;if((typeof t==="undefined"?"undefined":u(t))==="object"){r=t.min||0;a=t.max}else{
// backwards compatibility: isByteLength(str, min [, max])
r=arguments[1];a=arguments[2]}var l=encodeURI(e).split(/%..|./).length-1;return l>=r&&(typeof a==="undefined"||l<=a)}e.exports=t["default"]},/* 43 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=i;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}var l=/^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/;var o=/^[0-9A-F]{1,4}$/i;function i(e){var t=arguments.length>1&&arguments[1]!==undefined?arguments[1]:"";(0,a.default)(e);t=String(t);if(!t){return i(e,4)||i(e,6)}else if(t==="4"){if(!l.test(e)){return false}var r=e.split(".").sort(function(e,t){return e-t});return r[3]<=255}else if(t==="6"){var u=e.split(":");var n=false;// marker to indicate ::
// At least some OS accept the last 32 bits of an IPv6 address
// (i.e. 2 of the blocks) in IPv4 notation, and RFC 3493 says
// that '::ffff:a.b.c.d' is valid for IPv4-mapped IPv6 addresses,
// and '::a.b.c.d' is deprecated, but also valid.
var f=i(u[u.length-1],4);var s=f?7:8;if(u.length>s){return false}
// initial or final ::
if(e==="::"){return true}else if(e.substr(0,2)==="::"){u.shift();u.shift();n=true}else if(e.substr(e.length-2)==="::"){u.pop();u.pop();n=true}for(var d=0;d<u.length;++d){
// test for a :: which can not be at the string start/end
// since those cases have been handled above
if(u[d]===""&&d>0&&d<u.length-1){if(n){return false}n=true}else if(f&&d===u.length-1){}else if(!o.test(u[d])){return false}}if(n){return u.length>=1}return u.length===s}return false}e.exports=t["default"]},/* 44 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});var u=t.alpha={"en-US":/^[A-Z]+$/i,"cs-CZ":/^[A-ZÁČĎÉĚÍŇÓŘŠŤÚŮÝŽ]+$/i,"da-DK":/^[A-ZÆØÅ]+$/i,"de-DE":/^[A-ZÄÖÜß]+$/i,"es-ES":/^[A-ZÁÉÍÑÓÚÜ]+$/i,"fr-FR":/^[A-ZÀÂÆÇÉÈÊËÏÎÔŒÙÛÜŸ]+$/i,"nl-NL":/^[A-ZÉËÏÓÖÜ]+$/i,"hu-HU":/^[A-ZÁÉÍÓÖŐÚÜŰ]+$/i,"pl-PL":/^[A-ZĄĆĘŚŁŃÓŻŹ]+$/i,"pt-PT":/^[A-ZÃÁÀÂÇÉÊÍÕÓÔÚÜ]+$/i,"ru-RU":/^[А-ЯЁ]+$/i,"sr-RS@latin":/^[A-ZČĆŽŠĐ]+$/i,"sr-RS":/^[А-ЯЂЈЉЊЋЏ]+$/i,"tr-TR":/^[A-ZÇĞİıÖŞÜ]+$/i,"uk-UA":/^[А-ЩЬЮЯЄIЇҐ]+$/i,ar:/^[ءآأؤإئابةتثجحخدذرزسشصضطظعغفقكلمنهوىيًٌٍَُِّْٰ]+$/};var a=t.alphanumeric={"en-US":/^[0-9A-Z]+$/i,"cs-CZ":/^[0-9A-ZÁČĎÉĚÍŇÓŘŠŤÚŮÝŽ]+$/i,"da-DK":/^[0-9A-ZÆØÅ]$/i,"de-DE":/^[0-9A-ZÄÖÜß]+$/i,"es-ES":/^[0-9A-ZÁÉÍÑÓÚÜ]+$/i,"fr-FR":/^[0-9A-ZÀÂÆÇÉÈÊËÏÎÔŒÙÛÜŸ]+$/i,"hu-HU":/^[0-9A-ZÁÉÍÓÖŐÚÜŰ]+$/i,"nl-NL":/^[0-9A-ZÉËÏÓÖÜ]+$/i,"pl-PL":/^[0-9A-ZĄĆĘŚŁŃÓŻŹ]+$/i,"pt-PT":/^[0-9A-ZÃÁÀÂÇÉÊÍÕÓÔÚÜ]+$/i,"ru-RU":/^[0-9А-ЯЁ]+$/i,"sr-RS@latin":/^[0-9A-ZČĆŽŠĐ]+$/i,"sr-RS":/^[0-9А-ЯЂЈЉЊЋЏ]+$/i,"tr-TR":/^[0-9A-ZÇĞİıÖŞÜ]+$/i,"uk-UA":/^[0-9А-ЩЬЮЯЄIЇҐ]+$/i,ar:/^[٠١٢٣٤٥٦٧٨٩0-9ءآأؤإئابةتثجحخدذرزسشصضطظعغفقكلمنهوىيًٌٍَُِّْٰ]+$/};var n=t.englishLocales=["AU","GB","HK","IN","NZ","ZA","ZM"];for(var l,o=0;o<n.length;o++){l="en-"+n[o];u[l]=u["en-US"];a[l]=a["en-US"]}u["pt-BR"]=u["pt-PT"];a["pt-BR"]=a["pt-PT"];
// Source: http://www.localeplanet.com/java/
var i=t.arabicLocales=["AE","BH","DZ","EG","IQ","JO","KW","LB","LY","MA","QM","QA","SA","SD","SY","TN","YE"];for(var f,s=0;s<i.length;s++){f="ar-"+i[s];u[f]=u.ar;a[f]=a.ar}},/* 45 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.fullWidth=undefined;t.default=o;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}var l=t.fullWidth=/[^\u0020-\u007E\uFF61-\uFF9F\uFFA0-\uFFDC\uFFE8-\uFFEE0-9a-zA-Z]/;function o(e){(0,a.default)(e);return l.test(e)}},/* 46 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.halfWidth=undefined;t.default=o;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}var l=t.halfWidth=/[\u0020-\u007E\uFF61-\uFF9F\uFFA0-\uFFDC\uFFE8-\uFFEE0-9a-zA-Z]/;function o(e){(0,a.default)(e);return l.test(e)}},/* 47 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=o;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}var l=/^[0-9A-F]+$/i;function o(e){(0,a.default)(e);return l.test(e)}e.exports=t["default"]},/* 48 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=l;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}function l(e,t){(0,a.default)(e);var r=t?new RegExp("^["+t+"]+","g"):/^\s+/g;return e.replace(r,"")}e.exports=t["default"]},/* 49 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=l;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}function l(e,t){(0,a.default)(e);var r=t?new RegExp("["+t+"]"):/\s/;var u=e.length-1;while(u>=0&&r.test(e[u])){u--}return u<e.length?e.substr(0,u+1):e}e.exports=t["default"]},/* 50 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=l;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}function l(e,t){(0,a.default)(e);return e.replace(new RegExp("["+t+"]+","g"),"")}e.exports=t["default"]},/* 51 */
,/* 52 */
,/* 53 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});var u=r(37);var a=mt(u);var n=r(40);var l=mt(n);var o=r(54);var i=mt(o);var f=r(55);var s=mt(f);var d=r(56);var c=mt(d);var v=r(57);var _=mt(v);var p=r(58);var g=mt(p);var m=r(41);var y=mt(m);var h=r(59);var b=mt(h);var x=r(60);var M=mt(x);var F=r(43);var $=mt(F);var O=r(39);var A=mt(O);var j=r(61);var P=mt(j);var w=r(62);var S=mt(w);var k=r(63);var E=mt(k);var R=r(64);var C=mt(R);var D=r(65);var Z=mt(D);var L=r(66);var I=mt(L);var B=r(67);var U=mt(B);var N=r(45);var q=mt(N);var z=r(46);var T=mt(z);var W=r(68);var H=mt(W);var K=r(69);var G=mt(K);var J=r(70);var Y=mt(J);var Q=r(71);var X=mt(Q);var V=r(72);var ee=mt(V);var te=r(73);var re=mt(te);var ue=r(47);var ae=mt(ue);var ne=r(74);var le=mt(ne);var oe=r(75);var ie=mt(oe);var fe=r(76);var se=mt(fe);var de=r(77);var ce=mt(de);var ve=r(78);var _e=mt(ve);var pe=r(79);var ge=mt(pe);var me=r(80);var ye=mt(me);var he=r(42);var be=mt(he);var xe=r(81);var Me=mt(xe);var Fe=r(82);var $e=mt(Fe);var Oe=r(83);var Ae=mt(Oe);var je=r(84);var Pe=mt(je);var we=r(85);var Se=mt(we);var ke=r(86);var Ee=mt(ke);var Re=r(87);var Ce=mt(Re);var De=r(88);var Ze=mt(De);var Le=r(89);var Ie=mt(Le);var Be=r(90);var Ue=mt(Be);var Ne=r(91);var qe=mt(Ne);var ze=r(92);var Te=mt(ze);var We=r(93);var He=mt(We);var Ke=r(94);var Ge=mt(Ke);var Je=r(48);var Ye=mt(Je);var Qe=r(49);var Xe=mt(Qe);var Ve=r(95);var et=mt(Ve);var tt=r(96);var rt=mt(tt);var ut=r(97);var at=mt(ut);var nt=r(98);var lt=mt(nt);var ot=r(99);var it=mt(ot);var ft=r(50);var st=mt(ft);var dt=r(100);var ct=mt(dt);var vt=r(101);var _t=mt(vt);var pt=r(38);var gt=mt(pt);function mt(e){return e&&e.__esModule?e:{default:e}}var yt="8.0.0";var ht={version:yt,toDate:a.default,toFloat:l.default,toInt:i.default,toBoolean:s.default,equals:c.default,contains:_.default,matches:g.default,isEmail:y.default,isURL:b.default,isMACAddress:M.default,isIP:$.default,isFQDN:A.default,isBoolean:P.default,isAlpha:S.default,isAlphanumeric:E.default,isNumeric:C.default,isLowercase:Z.default,isUppercase:I.default,isAscii:U.default,isFullWidth:q.default,isHalfWidth:T.default,isVariableWidth:H.default,isMultibyte:G.default,isSurrogatePair:Y.default,isInt:X.default,isFloat:ee.default,isDecimal:re.default,isHexadecimal:ae.default,isDivisibleBy:le.default,isHexColor:ie.default,isISRC:se.default,isMD5:ce.default,isJSON:_e.default,isEmpty:ge.default,isLength:ye.default,isByteLength:be.default,isUUID:Me.default,isMongoId:$e.default,isAfter:Ae.default,isBefore:Pe.default,isIn:Se.default,isCreditCard:Ee.default,isISIN:Ce.default,isISBN:Ze.default,isISSN:Ie.default,isMobilePhone:Ue.default,isCurrency:qe.default,isISO8601:Te.default,isBase64:He.default,isDataURI:Ge.default,ltrim:Ye.default,rtrim:Xe.default,trim:et.default,escape:rt.default,unescape:at.default,stripLow:lt.default,whitelist:it.default,blacklist:st.default,isWhitelisted:ct.default,normalizeEmail:_t.default,toString:gt.default};t.default=ht;e.exports=t["default"]},/* 54 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=l;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}function l(e,t){(0,a.default)(e);return parseInt(e,t||10)}e.exports=t["default"]},/* 55 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=l;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}function l(e,t){(0,a.default)(e);if(t){return e==="1"||e==="true"}return e!=="0"&&e!=="false"&&e!==""}e.exports=t["default"]},/* 56 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=l;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}function l(e,t){(0,a.default)(e);return e===t}e.exports=t["default"]},/* 57 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=i;var u=r(34);var a=o(u);var n=r(38);var l=o(n);function o(e){return e&&e.__esModule?e:{default:e}}function i(e,t){(0,a.default)(e);return e.indexOf((0,l.default)(t))>=0}e.exports=t["default"]},/* 58 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=l;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}function l(e,t,r){(0,a.default)(e);if(Object.prototype.toString.call(t)!=="[object RegExp]"){t=new RegExp(t,r)}return t.test(e)}e.exports=t["default"]},/* 59 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=g;var u=r(34);var a=d(u);var n=r(39);var l=d(n);var o=r(43);var i=d(o);var f=r(36);var s=d(f);function d(e){return e&&e.__esModule?e:{default:e}}var c={protocols:["http","https","ftp"],require_tld:true,require_protocol:false,require_host:true,require_valid_protocol:true,allow_underscores:false,allow_trailing_dot:false,allow_protocol_relative_urls:false};var v=/^\[([^\]]+)\](?::([0-9]+))?$/;function _(e){return Object.prototype.toString.call(e)==="[object RegExp]"}function p(e,t){for(var r=0;r<t.length;r++){var u=t[r];if(e===u||_(u)&&u.test(e)){return true}}return false}function g(e,t){(0,a.default)(e);if(!e||e.length>=2083||/[\s<>]/.test(e)){return false}if(e.indexOf("mailto:")===0){return false}t=(0,s.default)(t,c);var r=void 0,u=void 0,n=void 0,o=void 0,f=void 0,d=void 0,_=void 0,g=void 0;_=e.split("#");e=_.shift();_=e.split("?");e=_.shift();_=e.split("://");if(_.length>1){r=_.shift();if(t.require_valid_protocol&&t.protocols.indexOf(r)===-1){return false}}else if(t.require_protocol){return false}else if(t.allow_protocol_relative_urls&&e.substr(0,2)==="//"){_[0]=e.substr(2)}e=_.join("://");if(e===""){return false}_=e.split("/");e=_.shift();if(e===""&&!t.require_host){return true}_=e.split("@");if(_.length>1){u=_.shift();if(u.indexOf(":")>=0&&u.split(":").length>2){return false}}o=_.join("@");d=null;g=null;var m=o.match(v);if(m){n="";g=m[1];d=m[2]||null}else{_=o.split(":");n=_.shift();if(_.length){d=_.join(":")}}if(d!==null){f=parseInt(d,10);if(!/^[0-9]+$/.test(d)||f<=0||f>65535){return false}}if(!(0,i.default)(n)&&!(0,l.default)(n,t)&&(!g||!(0,i.default)(g,6))){return false}n=n||g;if(t.host_whitelist&&!p(n,t.host_whitelist)){return false}if(t.host_blacklist&&p(n,t.host_blacklist)){return false}return true}e.exports=t["default"]},/* 60 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=o;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}var l=/^([0-9a-fA-F][0-9a-fA-F]:){5}([0-9a-fA-F][0-9a-fA-F])$/;function o(e){(0,a.default)(e);return l.test(e)}e.exports=t["default"]},/* 61 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=l;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}function l(e){(0,a.default)(e);return["true","false","1","0"].indexOf(e)>=0}e.exports=t["default"]},/* 62 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=o;var u=r(34);var a=l(u);var n=r(44);function l(e){return e&&e.__esModule?e:{default:e}}function o(e){var t=arguments.length>1&&arguments[1]!==undefined?arguments[1]:"en-US";(0,a.default)(e);if(t in n.alpha){return n.alpha[t].test(e)}throw new Error("Invalid locale '"+t+"'")}e.exports=t["default"]},/* 63 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=o;var u=r(34);var a=l(u);var n=r(44);function l(e){return e&&e.__esModule?e:{default:e}}function o(e){var t=arguments.length>1&&arguments[1]!==undefined?arguments[1]:"en-US";(0,a.default)(e);if(t in n.alphanumeric){return n.alphanumeric[t].test(e)}throw new Error("Invalid locale '"+t+"'")}e.exports=t["default"]},/* 64 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=o;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}var l=/^[-+]?[0-9]+$/;function o(e){(0,a.default)(e);return l.test(e)}e.exports=t["default"]},/* 65 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=l;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}function l(e){(0,a.default)(e);return e===e.toLowerCase()}e.exports=t["default"]},/* 66 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=l;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}function l(e){(0,a.default)(e);return e===e.toUpperCase()}e.exports=t["default"]},/* 67 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=o;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}/* eslint-disable no-control-regex */
var l=/^[\x00-\x7F]+$/;/* eslint-enable no-control-regex */
function o(e){(0,a.default)(e);return l.test(e)}e.exports=t["default"]},/* 68 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=i;var u=r(34);var a=o(u);var n=r(45);var l=r(46);function o(e){return e&&e.__esModule?e:{default:e}}function i(e){(0,a.default)(e);return n.fullWidth.test(e)&&l.halfWidth.test(e)}e.exports=t["default"]},/* 69 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=o;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}/* eslint-disable no-control-regex */
var l=/[^\x00-\x7F]/;/* eslint-enable no-control-regex */
function o(e){(0,a.default)(e);return l.test(e)}e.exports=t["default"]},/* 70 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=o;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}var l=/[\uD800-\uDBFF][\uDC00-\uDFFF]/;function o(e){(0,a.default)(e);return l.test(e)}e.exports=t["default"]},/* 71 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=i;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}var l=/^(?:[-+]?(?:0|[1-9][0-9]*))$/;var o=/^[-+]?[0-9]+$/;function i(e,t){(0,a.default)(e);t=t||{};
// Get the regex to use for testing, based on whether
// leading zeroes are allowed or not.
var r=t.hasOwnProperty("allow_leading_zeroes")&&!t.allow_leading_zeroes?l:o;
// Check min/max/lt/gt
var u=!t.hasOwnProperty("min")||e>=t.min;var n=!t.hasOwnProperty("max")||e<=t.max;var i=!t.hasOwnProperty("lt")||e<t.lt;var f=!t.hasOwnProperty("gt")||e>t.gt;return r.test(e)&&u&&n&&i&&f}e.exports=t["default"]},/* 72 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=o;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}var l=/^(?:[-+])?(?:[0-9]+)?(?:\.[0-9]*)?(?:[eE][\+\-]?(?:[0-9]+))?$/;function o(e,t){(0,a.default)(e);t=t||{};if(e===""||e==="."){return false}return l.test(e)&&(!t.hasOwnProperty("min")||e>=t.min)&&(!t.hasOwnProperty("max")||e<=t.max)&&(!t.hasOwnProperty("lt")||e<t.lt)&&(!t.hasOwnProperty("gt")||e>t.gt)}e.exports=t["default"]},/* 73 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=o;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}var l=/^[-+]?([0-9]+|\.[0-9]+|[0-9]+\.[0-9]+)$/;function o(e){(0,a.default)(e);return e!==""&&l.test(e)}e.exports=t["default"]},/* 74 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=i;var u=r(34);var a=o(u);var n=r(40);var l=o(n);function o(e){return e&&e.__esModule?e:{default:e}}function i(e,t){(0,a.default)(e);return(0,l.default)(e)%parseInt(t,10)===0}e.exports=t["default"]},/* 75 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=o;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}var l=/^#?([0-9A-F]{3}|[0-9A-F]{6})$/i;function o(e){(0,a.default)(e);return l.test(e)}e.exports=t["default"]},/* 76 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=o;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}
// see http://isrc.ifpi.org/en/isrc-standard/code-syntax
var l=/^[A-Z]{2}[0-9A-Z]{3}\d{2}\d{5}$/;function o(e){(0,a.default)(e);return l.test(e)}e.exports=t["default"]},/* 77 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=o;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}var l=/^[a-f0-9]{32}$/;function o(e){(0,a.default)(e);return l.test(e)}e.exports=t["default"]},/* 78 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});var u=typeof Symbol==="function"&&typeof Symbol.iterator==="symbol"?function(e){return typeof e}:function(e){return e&&typeof Symbol==="function"&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e};t.default=o;var a=r(34);var n=l(a);function l(e){return e&&e.__esModule?e:{default:e}}function o(e){(0,n.default)(e);try{var t=JSON.parse(e);return!!t&&(typeof t==="undefined"?"undefined":u(t))==="object"}catch(e){}return false}e.exports=t["default"]},/* 79 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=l;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}function l(e){(0,a.default)(e);return e.length===0}e.exports=t["default"]},/* 80 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});var u=typeof Symbol==="function"&&typeof Symbol.iterator==="symbol"?function(e){return typeof e}:function(e){return e&&typeof Symbol==="function"&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e};t.default=o;var a=r(34);var n=l(a);function l(e){return e&&e.__esModule?e:{default:e}}/* eslint-disable prefer-rest-params */
function o(e,t){(0,n.default)(e);var r=void 0;var a=void 0;if((typeof t==="undefined"?"undefined":u(t))==="object"){r=t.min||0;a=t.max}else{
// backwards compatibility: isLength(str, min [, max])
r=arguments[1];a=arguments[2]}var l=e.match(/[\uD800-\uDBFF][\uDC00-\uDFFF]/g)||[];var o=e.length-l.length;return o>=r&&(typeof a==="undefined"||o<=a)}e.exports=t["default"]},/* 81 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=o;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}var l={3:/^[0-9A-F]{8}-[0-9A-F]{4}-3[0-9A-F]{3}-[0-9A-F]{4}-[0-9A-F]{12}$/i,4:/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i,5:/^[0-9A-F]{8}-[0-9A-F]{4}-5[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i,all:/^[0-9A-F]{8}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{12}$/i};function o(e){var t=arguments.length>1&&arguments[1]!==undefined?arguments[1]:"all";(0,a.default)(e);var r=l[t];return r&&r.test(e)}e.exports=t["default"]},/* 82 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=i;var u=r(34);var a=o(u);var n=r(47);var l=o(n);function o(e){return e&&e.__esModule?e:{default:e}}function i(e){(0,a.default)(e);return(0,l.default)(e)&&e.length===24}e.exports=t["default"]},/* 83 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=i;var u=r(34);var a=o(u);var n=r(37);var l=o(n);function o(e){return e&&e.__esModule?e:{default:e}}function i(e){var t=arguments.length>1&&arguments[1]!==undefined?arguments[1]:String(new Date);(0,a.default)(e);var r=(0,l.default)(t);var u=(0,l.default)(e);return!!(u&&r&&u>r)}e.exports=t["default"]},/* 84 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=i;var u=r(34);var a=o(u);var n=r(37);var l=o(n);function o(e){return e&&e.__esModule?e:{default:e}}function i(e){var t=arguments.length>1&&arguments[1]!==undefined?arguments[1]:String(new Date);(0,a.default)(e);var r=(0,l.default)(t);var u=(0,l.default)(e);return!!(u&&r&&u<r)}e.exports=t["default"]},/* 85 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});var u=typeof Symbol==="function"&&typeof Symbol.iterator==="symbol"?function(e){return typeof e}:function(e){return e&&typeof Symbol==="function"&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e};t.default=f;var a=r(34);var n=i(a);var l=r(38);var o=i(l);function i(e){return e&&e.__esModule?e:{default:e}}function f(e,t){(0,n.default)(e);var r=void 0;if(Object.prototype.toString.call(t)==="[object Array]"){var a=[];for(r in t){if({}.hasOwnProperty.call(t,r)){a[r]=(0,o.default)(t[r])}}return a.indexOf(e)>=0}else if((typeof t==="undefined"?"undefined":u(t))==="object"){return t.hasOwnProperty(e)}else if(t&&typeof t.indexOf==="function"){return t.indexOf(e)>=0}return false}e.exports=t["default"]},/* 86 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=o;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}/* eslint-disable max-len */
var l=/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|(222[1-9]|22[3-9][0-9]|2[3-6][0-9]{2}|27[01][0-9]|2720)[0-9]{12}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11}|62[0-9]{14})$/;/* eslint-enable max-len */
function o(e){(0,a.default)(e);var t=e.replace(/[- ]+/g,"");if(!l.test(t)){return false}var r=0;var u=void 0;var n=void 0;var o=void 0;for(var i=t.length-1;i>=0;i--){u=t.substring(i,i+1);n=parseInt(u,10);if(o){n*=2;if(n>=10){r+=n%10+1}else{r+=n}}else{r+=n}o=!o}return!!(r%10===0?t:false)}e.exports=t["default"]},/* 87 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=o;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}var l=/^[A-Z]{2}[0-9A-Z]{9}[0-9]$/;function o(e){(0,a.default)(e);if(!l.test(e)){return false}var t=e.replace(/[A-Z]/g,function(e){return parseInt(e,36)});var r=0;var u=void 0;var n=void 0;var o=true;for(var i=t.length-2;i>=0;i--){u=t.substring(i,i+1);n=parseInt(u,10);if(o){n*=2;if(n>=10){r+=n+1}else{r+=n}}else{r+=n}o=!o}return parseInt(e.substr(e.length-1),10)===(1e4-r)%10}e.exports=t["default"]},/* 88 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=f;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}var l=/^(?:[0-9]{9}X|[0-9]{10})$/;var o=/^(?:[0-9]{13})$/;var i=[1,3];function f(e){var t=arguments.length>1&&arguments[1]!==undefined?arguments[1]:"";(0,a.default)(e);t=String(t);if(!t){return f(e,10)||f(e,13)}var r=e.replace(/[\s-]+/g,"");var u=0;var n=void 0;if(t==="10"){if(!l.test(r)){return false}for(n=0;n<9;n++){u+=(n+1)*r.charAt(n)}if(r.charAt(9)==="X"){u+=10*10}else{u+=10*r.charAt(9)}if(u%11===0){return!!r}}else if(t==="13"){if(!o.test(r)){return false}for(n=0;n<12;n++){u+=i[n%2]*r.charAt(n)}if(r.charAt(12)-(10-u%10)%10===0){return!!r}}return false}e.exports=t["default"]},/* 89 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=o;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}var l="^\\d{4}-?\\d{3}[\\dX]$";function o(e){var t=arguments.length>1&&arguments[1]!==undefined?arguments[1]:{};(0,a.default)(e);var r=l;r=t.require_hyphen?r.replace("?",""):r;r=t.case_sensitive?new RegExp(r):new RegExp(r,"i");if(!r.test(e)){return false}var u=e.replace("-","");var n=8;var o=0;var i=true;var f=false;var s=undefined;try{for(var d=u[Symbol.iterator](),c;!(i=(c=d.next()).done);i=true){var v=c.value;var _=v.toUpperCase()==="X"?10:+v;o+=_*n;--n}}catch(e){f=true;s=e}finally{try{if(!i&&d.return){d.return()}}finally{if(f){throw s}}}return o%11===0}e.exports=t["default"]},/* 90 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=o;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}/* eslint-disable max-len */
var l={"ar-DZ":/^(\+?213|0)(5|6|7)\d{8}$/,"ar-SY":/^(!?(\+?963)|0)?9\d{8}$/,"ar-SA":/^(!?(\+?966)|0)?5\d{8}$/,"en-US":/^(\+?1)?[2-9]\d{2}[2-9](?!11)\d{6}$/,"cs-CZ":/^(\+?420)? ?[1-9][0-9]{2} ?[0-9]{3} ?[0-9]{3}$/,"de-DE":/^(\+?49[ \.\-])?([\(]{1}[0-9]{1,6}[\)])?([0-9 \.\-\/]{3,20})((x|ext|extension)[ ]?[0-9]{1,4})?$/,"da-DK":/^(\+?45)?(\d{8})$/,"el-GR":/^(\+?30)?(69\d{8})$/,"en-AU":/^(\+?61|0)4\d{8}$/,"en-GB":/^(\+?44|0)7\d{9}$/,"en-HK":/^(\+?852\-?)?[569]\d{3}\-?\d{4}$/,"en-IN":/^(\+?91|0)?[789]\d{9}$/,"en-KE":/^(\+?254|0)?[7]\d{8}$/,"en-NG":/^(\+?234|0)?[789]\d{9}$/,"en-NZ":/^(\+?64|0)2\d{7,9}$/,"en-UG":/^(\+?256|0)?[7]\d{8}$/,"en-RW":/^(\+?250|0)?[7]\d{8}$/,"en-TZ":/^(\+?255|0)?[67]\d{8}$/,"en-ZA":/^(\+?27|0)\d{9}$/,"en-ZM":/^(\+?26)?09[567]\d{7}$/,"es-ES":/^(\+?34)?(6\d{1}|7[1234])\d{7}$/,"fi-FI":/^(\+?358|0)\s?(4(0|1|2|4|5|6)?|50)\s?(\d\s?){4,8}\d$/,"fa-IR":/^(\+?98[\-\s]?|0)9[0-39]\d[\-\s]?\d{3}[\-\s]?\d{4}$/,"fr-FR":/^(\+?33|0)[67]\d{8}$/,"he-IL":/^(\+972|0)([23489]|5[0248]|77)[1-9]\d{6}/,"hu-HU":/^(\+?36)(20|30|70)\d{7}$/,"lt-LT":/^(\+370|8)\d{8}$/,"id-ID":/^(\+?62|0[1-9])[\s|\d]+$/,"it-IT":/^(\+?39)?\s?3\d{2} ?\d{6,7}$/,"ko-KR":/^((\+?82)[ \-]?)?0?1([0|1|6|7|8|9]{1})[ \-]?\d{3,4}[ \-]?\d{4}$/,"ja-JP":/^(\+?81|0)\d{1,4}[ \-]?\d{1,4}[ \-]?\d{4}$/,"ms-MY":/^(\+?6?01){1}(([145]{1}(\-|\s)?\d{7,8})|([236789]{1}(\s|\-)?\d{7}))$/,"nb-NO":/^(\+?47)?[49]\d{7}$/,"nl-BE":/^(\+?32|0)4?\d{8}$/,"nn-NO":/^(\+?47)?[49]\d{7}$/,"pl-PL":/^(\+?48)? ?[5-8]\d ?\d{3} ?\d{2} ?\d{2}$/,"pt-BR":/^(\+?55|0)\-?[1-9]{2}\-?[2-9]{1}\d{3,4}\-?\d{4}$/,"pt-PT":/^(\+?351)?9[1236]\d{7}$/,"ro-RO":/^(\+?4?0)\s?7\d{2}(\/|\s|\.|\-)?\d{3}(\s|\.|\-)?\d{3}$/,"en-PK":/^((\+92)|(0092))-{0,1}\d{3}-{0,1}\d{7}$|^\d{11}$|^\d{4}-\d{7}$/,"ru-RU":/^(\+?7|8)?9\d{9}$/,"sr-RS":/^(\+3816|06)[- \d]{5,9}$/,"tr-TR":/^(\+?90|0)?5\d{9}$/,"vi-VN":/^(\+?84|0)?((1(2([0-9])|6([2-9])|88|99))|(9((?!5)[0-9])))([0-9]{7})$/,"zh-CN":/^(\+?0?86\-?)?1[345789]\d{9}$/,"zh-TW":/^(\+?886\-?|0)?9\d{8}$/};/* eslint-enable max-len */
// aliases
l["en-CA"]=l["en-US"];l["fr-BE"]=l["nl-BE"];l["zh-HK"]=l["en-HK"];function o(e,t){(0,a.default)(e);if(t in l){return l[t].test(e)}else if(t==="any"){return!!Object.values(l).find(function(t){return t.test(e)})}throw new Error("Invalid locale '"+t+"'")}e.exports=t["default"]},/* 91 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=s;var u=r(36);var a=o(u);var n=r(34);var l=o(n);function o(e){return e&&e.__esModule?e:{default:e}}function i(e){var t="(\\"+e.symbol.replace(/\./g,"\\.")+")"+(e.require_symbol?"":"?"),r="-?",u="[1-9]\\d*",a="[1-9]\\d{0,2}(\\"+e.thousands_separator+"\\d{3})*",n=["0",u,a],l="("+n.join("|")+")?",o="(\\"+e.decimal_separator+"\\d{2})?";var i=l+o;
// default is negative sign before symbol, but there are two other options (besides parens)
if(e.allow_negatives&&!e.parens_for_negatives){if(e.negative_sign_after_digits){i+=r}else if(e.negative_sign_before_digits){i=r+i}}
// South African Rand, for example, uses R 123 (space) and R-123 (no space)
if(e.allow_negative_sign_placeholder){i="( (?!\\-))?"+i}else if(e.allow_space_after_symbol){i=" ?"+i}else if(e.allow_space_after_digits){i+="( (?!$))?"}if(e.symbol_after_digits){i+=t}else{i=t+i}if(e.allow_negatives){if(e.parens_for_negatives){i="(\\("+i+"\\)|"+i+")"}else if(!(e.negative_sign_before_digits||e.negative_sign_after_digits)){i=r+i}}
// ensure there's a dollar and/or decimal amount, and that
// it doesn't start with a space or a negative sign followed by a space
return new RegExp("^(?!-? )(?=.*\\d)"+i+"$")}var f={symbol:"$",require_symbol:false,allow_space_after_symbol:false,symbol_after_digits:false,allow_negatives:true,parens_for_negatives:false,negative_sign_before_digits:false,negative_sign_after_digits:false,allow_negative_sign_placeholder:false,thousands_separator:",",decimal_separator:".",allow_space_after_digits:false};function s(e,t){(0,l.default)(e);t=(0,a.default)(t,f);return i(t).test(e)}e.exports=t["default"]},/* 92 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.iso8601=undefined;t.default=function(e){(0,a.default)(e);return l.test(e)};var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}/* eslint-disable max-len */
// from http://goo.gl/0ejHHW
var l=t.iso8601=/^([\+-]?\d{4}(?!\d{2}\b))((-?)((0[1-9]|1[0-2])(\3([12]\d|0[1-9]|3[01]))?|W([0-4]\d|5[0-2])(-?[1-7])?|(00[1-9]|0[1-9]\d|[12]\d{2}|3([0-5]\d|6[1-6])))([T\s]((([01]\d|2[0-3])((:?)[0-5]\d)?|24:?00)([\.,]\d+(?!:))?)?(\17[0-5]\d([\.,]\d+)?)?([zZ]|([\+-])([01]\d|2[0-3]):?([0-5]\d)?)?)?)?$/},/* 93 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=o;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}var l=/[^A-Z0-9+\/=]/i;function o(e){(0,a.default)(e);var t=e.length;if(!t||t%4!==0||l.test(e)){return false}var r=e.indexOf("=");return r===-1||r===t-1||r===t-2&&e[t-1]==="="}e.exports=t["default"]},/* 94 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=o;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}var l=/^\s*data:([a-z]+\/[a-z0-9\-\+]+(;[a-z\-]+=[a-z0-9\-]+)?)?(;base64)?,[a-z0-9!\$&',\(\)\*\+,;=\-\._~:@\/\?%\s]*\s*$/i;// eslint-disable-line max-len
function o(e){(0,a.default)(e);return l.test(e)}e.exports=t["default"]},/* 95 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=i;var u=r(49);var a=o(u);var n=r(48);var l=o(n);function o(e){return e&&e.__esModule?e:{default:e}}function i(e,t){return(0,a.default)((0,l.default)(e,t),t)}e.exports=t["default"]},/* 96 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=l;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}function l(e){(0,a.default)(e);return e.replace(/&/g,"&amp;").replace(/"/g,"&quot;").replace(/'/g,"&#x27;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\//g,"&#x2F;").replace(/\\/g,"&#x5C;").replace(/`/g,"&#96;")}e.exports=t["default"]},/* 97 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=l;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}function l(e){(0,a.default)(e);return e.replace(/&amp;/g,"&").replace(/&quot;/g,'"').replace(/&#x27;/g,"'").replace(/&lt;/g,"<").replace(/&gt;/g,">").replace(/&#x2F;/g,"/").replace(/&#96;/g,"`")}e.exports=t["default"]},/* 98 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=i;var u=r(34);var a=o(u);var n=r(50);var l=o(n);function o(e){return e&&e.__esModule?e:{default:e}}function i(e,t){(0,a.default)(e);var r=t?"\\x00-\\x09\\x0B\\x0C\\x0E-\\x1F\\x7F":"\\x00-\\x1F\\x7F";return(0,l.default)(e,r)}e.exports=t["default"]},/* 99 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=l;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}function l(e,t){(0,a.default)(e);return e.replace(new RegExp("[^"+t+"]+","g"),"")}e.exports=t["default"]},/* 100 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=l;var u=r(34);var a=n(u);function n(e){return e&&e.__esModule?e:{default:e}}function l(e,t){(0,a.default)(e);for(var r=e.length-1;r>=0;r--){if(t.indexOf(e[r])===-1){return false}}return true}e.exports=t["default"]},/* 101 */
/***/
function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:true});t.default=c;var u=r(41);var a=o(u);var n=r(36);var l=o(n);function o(e){return e&&e.__esModule?e:{default:e}}var i={
// The following options apply to all email addresses
// Lowercases the local part of the email address.
// Please note this may violate RFC 5321 as per http://stackoverflow.com/a/9808332/192024).
// The domain is always lowercased, as per RFC 1035
all_lowercase:true,
// The following conversions are specific to GMail
// Lowercases the local part of the GMail address (known to be case-insensitive)
gmail_lowercase:true,
// Removes dots from the local part of the email address, as that's ignored by GMail
gmail_remove_dots:true,
// Removes the subaddress (e.g. "+foo") from the email address
gmail_remove_subaddress:true,
// Conversts the googlemail.com domain to gmail.com
gmail_convert_googlemaildotcom:true,
// The following conversions are specific to Outlook.com / Windows Live / Hotmail
// Lowercases the local part of the Outlook.com address (known to be case-insensitive)
outlookdotcom_lowercase:true,
// Removes the subaddress (e.g. "+foo") from the email address
outlookdotcom_remove_subaddress:true,
// The following conversions are specific to Yahoo
// Lowercases the local part of the Yahoo address (known to be case-insensitive)
yahoo_lowercase:true,
// Removes the subaddress (e.g. "-foo") from the email address
yahoo_remove_subaddress:true,
// The following conversions are specific to iCloud
// Lowercases the local part of the iCloud address (known to be case-insensitive)
icloud_lowercase:true,
// Removes the subaddress (e.g. "+foo") from the email address
icloud_remove_subaddress:true};
// List of domains used by iCloud
var f=["icloud.com","me.com"];
// List of domains used by Outlook.com and its predecessors
// This list is likely incomplete.
// Partial reference:
// https://blogs.office.com/2013/04/17/outlook-com-gets-two-step-verification-sign-in-by-alias-and-new-international-domains/
var s=["hotmail.at","hotmail.be","hotmail.ca","hotmail.cl","hotmail.co.il","hotmail.co.nz","hotmail.co.th","hotmail.co.uk","hotmail.com","hotmail.com.ar","hotmail.com.au","hotmail.com.br","hotmail.com.gr","hotmail.com.mx","hotmail.com.pe","hotmail.com.tr","hotmail.com.vn","hotmail.cz","hotmail.de","hotmail.dk","hotmail.es","hotmail.fr","hotmail.hu","hotmail.id","hotmail.ie","hotmail.in","hotmail.it","hotmail.jp","hotmail.kr","hotmail.lv","hotmail.my","hotmail.ph","hotmail.pt","hotmail.sa","hotmail.sg","hotmail.sk","live.be","live.co.uk","live.com","live.com.ar","live.com.mx","live.de","live.es","live.eu","live.fr","live.it","live.nl","msn.com","outlook.at","outlook.be","outlook.cl","outlook.co.il","outlook.co.nz","outlook.co.th","outlook.com","outlook.com.ar","outlook.com.au","outlook.com.br","outlook.com.gr","outlook.com.pe","outlook.com.tr","outlook.com.vn","outlook.cz","outlook.de","outlook.dk","outlook.es","outlook.fr","outlook.hu","outlook.id","outlook.ie","outlook.in","outlook.it","outlook.jp","outlook.kr","outlook.lv","outlook.my","outlook.ph","outlook.pt","outlook.sa","outlook.sg","outlook.sk","passport.com"];
// List of domains used by Yahoo Mail
// This list is likely incomplete
var d=["rocketmail.com","yahoo.ca","yahoo.co.uk","yahoo.com","yahoo.de","yahoo.fr","yahoo.in","yahoo.it","ymail.com"];function c(e,t){t=(0,l.default)(t,i);if(!(0,a.default)(e)){return false}var r=e.split("@");var u=r.pop();var n=r.join("@");var o=[n,u];
// The domain is always lowercased, as it's case-insensitive per RFC 1035
o[1]=o[1].toLowerCase();if(o[1]==="gmail.com"||o[1]==="googlemail.com"){
// Address is GMail
if(t.gmail_remove_subaddress){o[0]=o[0].split("+")[0]}if(t.gmail_remove_dots){o[0]=o[0].replace(/\./g,"")}if(!o[0].length){return false}if(t.all_lowercase||t.gmail_lowercase){o[0]=o[0].toLowerCase()}o[1]=t.gmail_convert_googlemaildotcom?"gmail.com":o[1]}else if(~f.indexOf(o[1])){
// Address is iCloud
if(t.icloud_remove_subaddress){o[0]=o[0].split("+")[0]}if(!o[0].length){return false}if(t.all_lowercase||t.icloud_lowercase){o[0]=o[0].toLowerCase()}}else if(~s.indexOf(o[1])){
// Address is Outlook.com
if(t.outlookdotcom_remove_subaddress){o[0]=o[0].split("+")[0]}if(!o[0].length){return false}if(t.all_lowercase||t.outlookdotcom_lowercase){o[0]=o[0].toLowerCase()}}else if(~d.indexOf(o[1])){
// Address is Yahoo
if(t.yahoo_remove_subaddress){var c=o[0].split("-");o[0]=c.length>1?c.slice(0,-1).join("-"):c[0]}if(!o[0].length){return false}if(t.all_lowercase||t.yahoo_lowercase){o[0]=o[0].toLowerCase()}}else if(t.all_lowercase){
// Any other address
o[0]=o[0].toLowerCase()}return o.join("@")}e.exports=t["default"]}]);