webpackJsonp([7],{14:function(e,t,n){"use strict";(function(e){function i(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(t,"__esModule",{value:!0});var a=function(){function e(e,t){for(var n=0;n<t.length;n++){var i=t[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}return function(t,n,i){return n&&e(t.prototype,n),i&&e(t,i),t}}(),o=n(34),s=function(){function t(){i(this,t)}return a(t,[{key:"init",value:function(){var t=this;document.querySelector("#slack-url").addEventListener("focusout",function(n){var i=n.target.value,a=n.target.getAttribute("data-cohort"),s={action:"save_slack_url",cohort_id:a,slack:i};t.sendForm(s,function(t){e(n.target).closest(".input-group").append('<span class="glyphicon glyphicon-ok inside" style="color:green;"></span>'),o.BCMessaging.notify(o.BCMessaging.SUCCESS,"The Slack URL was updated sucessfully."),setTimeout(function(){var e=document.querySelector(".input-group .glyphicon.inside");e.parentNode.removeChild(e)},2e3)})}),document.querySelector("#class_attendancy .send-btn").addEventListener("click",function(n){var i={},a=0;e(".attendants").each(function(){e(this).prop("checked")?i[e(this).val()]=e("#student"+e(this).val()).val():i[e(this).val()]=!1,a=e(this).data("cohort")}),t.sendAttendancy(a,i)}),document.querySelector("#update_repls .send-btn").addEventListener("click",function(n){var i={},a=0;e("#update_repls input").each(function(t){i[e(this).attr("id")]=e(this).val(),a=e(this).data("cohort")}),t.updateReplits(a,i)})}},{key:"sendAttendancy",value:function(e,t){var n={action:"check_attendancy",cohort_id:e,attendants:t};return this.sendForm(n),!1}},{key:"updateReplits",value:function(e,t){var n={action:"update_replits",repls:t,cohort_id:e};return this.sendForm(n),!1}},{key:"sendForm",value:function(t){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null;e.ajax({url:WPAS_APP.ajax_url,data:t,method:"POST",success:function(e){e&&("200"==e.code?n?n():window.location.reload():o.BCMessaging.notify(o.BCMessaging.ERROR,e.msg))}})}}]),t}();t.default=s}).call(t,n(0))},34:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});t.BCMessaging=function(){function e(e,i){s||n(e),t(i)}function t(e){var t=document.createElement("div");t.classList.add("single-notification"),t.innerHTML=a()(e.type,e.message),s.appendChild(t);for(var n=t.childNodes,o=0;o<n.length;o++)if("close"==n[o].className){n[o].addEventListener("click",function(){s.removeChild(t)});break}setTimeout(function(){t.classList.add("about-to-close"),setTimeout(function(){s.removeChild(t),0==s.childNodes.length&&i()},500)},3e3)}function n(e){s=document.createElement("div"),s.classList.add("bcnotification"),s.classList.add(e+"-notification"),document.body.appendChild(s)}function i(){s&&(s.parentNode.removeChild(s),s=null)}function a(){return function(e,t){return'<div class="inner-message alert alert-'+e+'">\n                                    <button type="button" class="close" data-dismiss="alert">&times;</button>\n                                    '+t+"\n                                </div>"}}var o={};o.ERROR="danger",o.WARNING="warning",o.SUCCESS="success";var s=null,c=[];return o.addMessage=function(e,t){void 0===c[e]&&(c[e]=[]),c[e].push(t)},o.getMessages=function(e){return void 0===c[e]&&(c[e]=[]),c[e]},o.notify=function(t,n){e("top",{type:t,message:n})},o.notifyPending=function(t){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null,i="<ul>";n?n.forEach(function(e){i+="<li>"+e+"</li>"}):c[t].forEach(function(e){i+="<li>"+e+"</li>"}),i+="</ul>",c[t]=[],e("top",{type:t,message:i})},o}()}});