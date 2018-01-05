webpackJsonp([4],{/***/
35:/***/
function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:true});var a=t.BCMessaging=function(){var e={};e.ERROR="danger";e.WARNING="warning";e.SUCCESS="success";var t=null;var n=[];e.addMessage=function(e,t){if(typeof n[e]=="undefined")n[e]=[];n[e].push(t)};e.getMessages=function(e){if(typeof n[e]=="undefined")n[e]=[];return n[e]};e.notify=function(e,t){a("top",{type:e,message:t})};e.notifyPending=function(e){var t=arguments.length>1&&arguments[1]!==undefined?arguments[1]:null;var o="<ul>";if(!t)n[e].forEach(function(e){o+="<li>"+e+"</li>"});else t.forEach(function(e){o+="<li>"+e+"</li>"});o+="</ul>";n[e]=[];a("top",{type:e,message:o})};function a(e,n){if(!t)r(e);o(n)}function o(e){var n=document.createElement("div");n.classList.add("single-notification");n.innerHTML=u()(e.type,e.message);t.appendChild(n);var a=n.childNodes;for(var o=0;o<a.length;o++){if(a[o].className=="close"){a[o].addEventListener("click",function(){t.removeChild(n)});break}}setTimeout(function(){n.classList.add("about-to-close");setTimeout(function(){t.removeChild(n);if(t.childNodes.length==0)i()},500)},3e3)}function r(e){t=document.createElement("div");t.classList.add("bcnotification");t.classList.add(e+"-notification");document.body.appendChild(t)}function i(){if(t){t.parentNode.removeChild(t);t=null}}function u(){return function(e,t){return'<div class="inner-message alert alert-'+e+'">\n                                    <button type="button" class="close" data-dismiss="alert">&times;</button>\n                                    '+t+"\n                                </div>"}}return e}()},/***/
51:/***/
function(e,t,n){"use strict";/* WEBPACK VAR INJECTION */
(function(e){Object.defineProperty(t,"__esModule",{value:true});t.BadgesManager=undefined;var a=n(35);var o=t.BadgesManager=function(){var t={};var n=[];var o="";var r=false;var i=false;var u=false;t.init=function(e){o=e;document.querySelectorAll(o).forEach(function(e){e.addEventListener("mouseenter",function(e){return c(e)});e.addEventListener("mouseout",function(e){return s(e)})})};function s(t){r=false;if(u)i=true;document.querySelectorAll(o).forEach(function(t){if(!r)e(t.parentNode).popover("hide")})}function c(t){
//console.log(e);
r=true;var s=n;var c=e(t.target).data("slug");if(typeof c==="undefined")return;if(typeof s[c]!=="undefined"){document.querySelectorAll(o).forEach(function(n){if(n==t.target){e(t.target.parentNode).popover("show")}else e(n.parentNode).popover("hide")});return s[c]}else{s[c]={description:"Loading..."};u=true;e(t.target.parentNode).popover({placement:function e(n,a){var o=l(t.target);if(o.left>515){return"left"}if(o.left<515){return"right"}if(o.top<110){return"bottom"}return"top"},content:function e(){return s[c].description}}).popover("show");e.ajax({url:WPAS_APP.ajax_url,method:"GET",data:{action:"get_badge",badge:c},success:function n(r){u=false;if(r.code==200){s[c]=r.data;document.querySelectorAll(o).forEach(function(n){if(n==t.target){if(i)i=false;else e(t.target.parentNode).popover("show")}else e(n.parentNode).popover("hide")})}else a.BCMessaging.notify(a.BCMessaging.ERROR,r.msg)}})}}function l(e){var t=0,n=0;do{t+=e.offsetTop||0;n+=e.offsetLeft||0;e=e.offsetParent}while(e);return{top:t,left:n}}return t}()}).call(t,n(0))},/***/
9:/***/
function(e,t,n){"use strict";/* WEBPACK VAR INJECTION */
(function(e){Object.defineProperty(t,"__esModule",{value:true});var a=function(){function e(e,t){for(var n=0;n<t.length;n++){var a=t[n];a.enumerable=a.enumerable||false;a.configurable=true;if("value"in a)a.writable=true;Object.defineProperty(e,a.key,a)}}return function(t,n,a){if(n)e(t.prototype,n);if(a)e(t,a);return t}}();var o=n(35);var r=n(51);function i(e,t){if(!(e instanceof t)){throw new TypeError("Cannot call a class as a function")}}/**
*    Declaration of your module
*    @params modulename and undefined
**/
var u=function(){function t(){i(this,t)}a(t,[{key:"init",value:function t(){var n=this;document.querySelector("#modal-update_profile .send-btn").addEventListener("click",function(t){var a=e("#firstname").val();var o=e("#lastname").val();var r=e("#github").val();var i=e("#phonenumber").val();var u=e("#bio").val();/*
                if(!validator.isURL(github) || github.length==0) BCMessaging.addMessage(BCMessaging.ERROR,'The github URL must be a valid URL');
                
                let messages = BCMessaging.getMessages(BCMessaging.ERROR);
                if(messages.length>0) BCMessaging.notifyPending(BCMessaging.ERROR);
                else this.deliverAssignment(assignmentId,github);
                */
n.sendForm({action:"update_profile",firstname:a,lastname:o,github:r,phonenumber:i,bio:u})});document.querySelector("#modal-update_settings .send-btn").addEventListener("click",function(e){var t=document.querySelectorAll("#modal-update_settings form .settings");var a={};for(var o=0;o<t.length;o++){a[t[o].name]=t[o].checked}console.log(a);/*
                if(!validator.isURL(github) || github.length==0) BCMessaging.addMessage(BCMessaging.ERROR,'The github URL must be a valid URL');
                
                let messages = BCMessaging.getMessages(BCMessaging.ERROR);
                if(messages.length>0) BCMessaging.notifyPending(BCMessaging.ERROR);
                else this.deliverAssignment(assignmentId,github);
                */
n.sendForm({action:"update_settings",settings:a})});r.BadgesManager.init(".badg-img")}},{key:"sendForm",value:function t(n){e.ajax({url:WPAS_APP.ajax_url,method:"post",dataType:"json",data:n,success:function e(t){if(t){if(t.code=="200"){window.location.reload()}else{o.BCMessaging.notifyPending(o.BCMessaging.ERROR,t.msg)}}}})}},{key:"refreshBadges",value:function e(t){var n=document.querySelectorAll(".talent-badge li");console.log(n);n.forEach(function(e){var n=t.find(function(t){if(t.slug==e.getAttribute("data-slug"))return e});var a=e.childNodes;a.forEach(function(e){console.log(e);
//if the badge has a real URL
if(e.classList&&n.url&&n.url!=""&&e.classList.contains("avatar"))e.style.backgroundUrl="url('"+n.url+"')";
//If the badge has a name
if(e.classList&&n.name&&n.name!=""&&e.classList.contains("badge-name"))e.innerHTML=n.name})})}}]);return t}();t.default=u}).call(t,n(0))}});