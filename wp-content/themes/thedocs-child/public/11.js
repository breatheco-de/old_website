webpackJsonp([11],{/***/
4:/***/
function(e,r,n){"use strict";/* WEBPACK VAR INJECTION */
(function(e){Object.defineProperty(r,"__esModule",{value:true});var n=function(){function e(e,r){for(var n=0;n<r.length;n++){var t=r[n];t.enumerable=t.enumerable||false;t.configurable=true;if("value"in t)t.writable=true;Object.defineProperty(e,t.key,t)}}return function(r,n,t){if(n)e(r.prototype,n);if(t)e(r,t);return r}}();function t(e,r){if(!(e instanceof r)){throw new TypeError("Cannot call a class as a function")}}/**
*    Declaration of your module
*    @params modulename and undefined
**/
var a=function(){function r(){t(this,r);this.errorAlert=".alert-danger"}n(r,[{key:"init",value:function e(){var r=this;document.querySelector(".form-signin").addEventListener("submit",function(e){e.preventDefault();if(r.validateLogin())r.login();return false})}},{key:"validateLogin",value:function e(){var r=document.querySelector("#username").value;var n=document.querySelector("#password").value;if(r&&n)return true}},{key:"login",value:function e(){var r=document.querySelector("#username").value;var n=document.querySelector("#password").value;this.send(r,n)}},{key:"showError",value:function e(r){var n=document.querySelector(this.errorAlert);n.innerHTML=r;n.style.display="block";var t=document.querySelector("#login");t.disabled=false;t.innerHTML="Sign In";t.classList.add("btn-primary")}},{key:"hideError",value:function e(){var r=document.querySelector(this.errorAlert);r.innerHTML="";r.style.display="none";var n=document.querySelector("#login");n.disabled=false;n.innerHTML="Loading...";n.classList.remove("btn-primary")}},{key:"send",value:function r(n,t){var a=this;this.hideError();var o={action:"custom_login",username:n,password:t};
// the_ajax_script.ajaxurl is a variable that will contain the url to the ajax processing file
e.ajax({url:WPAS_APP.ajax_url,method:"post",dataType:"json",data:o,success:function e(r){if(r){if(r.code=="200"){window.location.href=r.data}else{a.showError(r.msg)}}}});return false}}]);return r}();r.default=a}).call(r,n(0))}});