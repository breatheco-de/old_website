webpackJsonp([3],{/***/
10:/***/
function(e,t,n){"use strict";/* WEBPACK VAR INJECTION */
(function(e){Object.defineProperty(t,"__esModule",{value:true});var o=function(){function e(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||false;o.configurable=true;if("value"in o)o.writable=true;Object.defineProperty(e,o.key,o)}}return function(t,n,o){if(n)e(t.prototype,n);if(o)e(t,o);return t}}();var i=n(34);var a=n(50);function r(e,t){if(!(e instanceof t)){throw new TypeError("Cannot call a class as a function")}}/**
*    Declaration of your module
*    @params modulename and undefined
**/
var u=function(){function t(){
//any properties here using this.propertyName
r(this,t)}o(t,[{key:"init",value:function e(){var t=this;a.BadgesManager.init(".badg-img");window.addEventListener("message",function(e){
// IMPORTANT: Check the origin of the data! 
if(~e.origin.indexOf("https://assets.breatheco.de")){
// The data has been sent from your site 
var n=document.querySelector("#student").value;var o=document.querySelector("#quiz").value;var a=document.querySelectorAll(".single-badge");if(e.data.started){t.sendForm({action:"save_attempt",student:n,quiz:o},function(){console.log("Quiz attempt successfully saved.")})}else{var r=Math.floor(e.data.passedQuestions/e.data.totalQuestions*100);if(r>75){a.forEach(function(e){var t=e.getAttribute("data-slug");var o=e.getAttribute("data-points");this.sendForm({action:"give_points",badge:t,student:n,points:o},function(){i.BCMessaging.notify(i.BCMessaging.SUCCESS,"Poins for "+t+" given successfully.");window.location.reload()})})}}}else{
// The data hasn't been sent from your site! 
// Be careful! Do not use it. 
return}})}},{key:"sendForm",value:function t(n){var o=arguments.length>1&&arguments[1]!==undefined?arguments[1]:null;
// the_ajax_script.ajaxurl is a variable that will contain the url to the ajax processing file
e.ajax({url:WPAS_APP.ajax_url,method:"post",dataType:"json",data:n,success:function e(t){if(t){if(t.code=="200"){if(o)o()}else{i.BCMessaging.notifyPending(i.BCMessaging.ERROR,t.msg)}}}})}}]);return t}();t.default=u}).call(t,n(0))},/***/
34:/***/
function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:true});var o=t.BCMessaging=function(){var e={};e.ERROR="danger";e.WARNING="warning";e.SUCCESS="success";var t=null;var n=[];e.addMessage=function(e,t){if(typeof n[e]=="undefined")n[e]=[];n[e].push(t)};e.getMessages=function(e){if(typeof n[e]=="undefined")n[e]=[];return n[e]};e.notify=function(e,t){o("top",{type:e,message:t})};e.notifyPending=function(e){var t=arguments.length>1&&arguments[1]!==undefined?arguments[1]:null;var i="<ul>";if(!t)n[e].forEach(function(e){i+="<li>"+e+"</li>"});else t.forEach(function(e){i+="<li>"+e+"</li>"});i+="</ul>";n[e]=[];o("top",{type:e,message:i})};function o(e,n){if(!t)a(e);i(n)}function i(e){var n=document.createElement("div");n.classList.add("single-notification");n.innerHTML=u()(e.type,e.message);t.appendChild(n);var o=n.childNodes;for(var i=0;i<o.length;i++){if(o[i].className=="close"){o[i].addEventListener("click",function(){t.removeChild(n)});break}}setTimeout(function(){n.classList.add("about-to-close");setTimeout(function(){t.removeChild(n);if(t.childNodes.length==0)r()},500)},3e3)}function a(e){t=document.createElement("div");t.classList.add("bcnotification");t.classList.add(e+"-notification");document.body.appendChild(t)}function r(){if(t){t.parentNode.removeChild(t);t=null}}function u(){return function(e,t){return'<div class="inner-message alert alert-'+e+'">\n                                    <button type="button" class="close" data-dismiss="alert">&times;</button>\n                                    '+t+"\n                                </div>"}}return e}()},/***/
50:/***/
function(e,t,n){"use strict";/* WEBPACK VAR INJECTION */
(function(e){Object.defineProperty(t,"__esModule",{value:true});t.BadgesManager=undefined;var o=n(34);var i=t.BadgesManager=function(){var t={};var n=[];var i="";var a=false;var r=false;var u=false;t.init=function(e){i=e;document.querySelectorAll(i).forEach(function(e){e.addEventListener("mouseenter",function(e){return f(e)});e.addEventListener("mouseout",function(e){return s(e)})})};function s(t){a=false;if(u)r=true;document.querySelectorAll(i).forEach(function(t){if(!a)e(t.parentNode).popover("hide")})}function f(t){
//console.log(e);
a=true;var s=n;var f=e(t.target).data("slug");if(typeof f==="undefined")return;if(typeof s[f]!=="undefined"){document.querySelectorAll(i).forEach(function(n){if(n==t.target){e(t.target.parentNode).popover("show")}else e(n.parentNode).popover("hide")});return s[f]}else{s[f]={description:"Loading..."};u=true;e(t.target.parentNode).popover({placement:function e(n,o){var i=c(t.target);if(i.left>515){return"left"}if(i.left<515){return"right"}if(i.top<110){return"bottom"}return"top"},content:function e(){return s[f].description}}).popover("show");e.ajax({url:WPAS_APP.ajax_url,method:"GET",data:{action:"get_badge",badge:f},success:function n(a){u=false;if(a.code==200){s[f]=a.data;document.querySelectorAll(i).forEach(function(n){if(n==t.target){if(r)r=false;else e(t.target.parentNode).popover("show")}else e(n.parentNode).popover("hide")})}else o.BCMessaging.notify(o.BCMessaging.ERROR,a.msg)}})}}function c(e){var t=0,n=0;do{t+=e.offsetTop||0;n+=e.offsetLeft||0;e=e.offsetParent}while(e);return{top:t,left:n}}return t}()}).call(t,n(0))}});