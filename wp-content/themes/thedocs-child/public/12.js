webpackJsonp([12],{2:function(a,t,e){"use strict";(function(a){a(document).ready(function(){if(a('.nav-rtab-wrapper a[href*="#"]:not([href="#"])').click(function(){if(a(".nav-rtab-wrapper > a").removeClass("nav-tab-active"),a(this).addClass("nav-tab-active"),location.pathname.replace(/^\//,"")==this.pathname.replace(/^\//,"")&&location.hostname==this.hostname){var t=a(this.hash);t.length&&(a(".nav-rtabs  .nav-rtab-holder").css("display","none"),a(t).css("display","block"),a(t.selector+" > .wpts-nav-section-holder").css("display","none"),a(t.selector+"_parent").css("display","block"),a(".nav-rtab-form").attr("action","options.php"+t.selector),a("html, body").animate({scrollTop:0},1))}}),a(".wpts-nav-sections > li > a").click(function(){var t=a(this).attr("href");if(-1!=t.indexOf("&")){var e=t.split("&"),s=e[0],n=e[1].replace("section=","#");a(".nav-rtabs .nav-rtab-holder").css("display","none"),a(s).css("display","block"),a(s+" > .wpts-nav-section-holder").css("display","none"),a(n).css("display","block"),a(".nav-rtab-form").attr("action","options.php"+t),a("html, body").animate({scrollTop:0},1)}}),window.location.hash.length){var t=window.location.hash;if(-1!=t.indexOf("&")){var e=t.split("&"),s=e[0],n=e[1].replace("section=","#");a(".nav-rtabs .nav-rtab-holder").css("display","none"),a(s).css("display","block"),a(n).css("display","block")}else a(".nav-rtabs .nav-rtab-holder").css("display","none"),a(t).css("display","block"),a(t+"_parent").css("display","block"),a(".nav-rtab-wrapper > a").removeClass("nav-tab-active"),a('.nav-rtab-wrapper a[href="'+t+'"]').each(function(e){a(this).addClass("nav-tab-active"),a(".nav-rtab-form").attr("action","options.php"+t)})}else{var t=a(".nav-rtab-wrapper > a").first().attr("href");a(t).css("display","block"),a(t+"_parent").css("display","block")}a(".nav-tab-wrapper").length>0&&a("#footer-thankyou").html('Thank you for creating with <a href="https://git.io/vi1Gr" target="_new">WPTS</a>'),a(".wpts_color_field").wpColorPicker(),a(".wpts_fa_field").wptsFa();var o;a(".wpts-file-field").click(function(){return a("html").addClass("Image"),o=a(this).prev().attr("id"),tb_show("Upload File","media-upload.php?type=image&amp;TB_iframe=true"),!1}),window.original_send_to_editor=window.send_to_editor,window.send_to_editor=function(t){o?(re=/\ssrc=(?:(?:'([^']*)')|(?:"([^"]*)")|([^\s]*))/i,res=t.match(re),src=res[1]||res[2]||res[3],a("#"+o).val(src),a(".wpts-file-field-preview").before("#"+o).attr("src",src),tb_remove(),a("html").removeClass("Image")):window.original_send_to_editor(t)},a(".add-new-option").click(function(t){var e=a(this).siblings("input").val();a.ajax({url:"admin-ajax.php",method:"post",dataType:"json",data:{action:"ajax_theme_option",target:a(this).data("target"),value:e,function:"add"},success:function(a){200==a.code?location.reload():alert("Something went wrong: "+a.message)},error:function(a,t,e){console.log(e)}}),t.preventDefault()}),a(".delete-array-option").click(function(t){a.ajax({url:"admin-ajax.php",method:"post",dataType:"json",data:{action:"ajax_theme_option",target:a(this).data("target"),value:a(this).data("key"),function:"delete"},success:function(a){200==a.code?location.reload():alert("Something went wrong: "+a.message)},error:function(a,t,e){console.log(e)}}),t.preventDefault()})}),function(t){t.fn.wptsFa=function(){return this.each(function(){var e=t(this),s=t(e).attr("name");t(e).hide(),t('<div class="wptsFA-container" id="'+s+'"><div class="wptsFA-icon"></div><div class="wptsFA-button">Select icon</div><div class="wptsFA-icons"></div></div>').insertBefore(e),t.get("https://raw.githubusercontent.com/FortAwesome/Font-Awesome/master/src/icons.yml",function(e){var n=jsyaml.load(e);a.each(n.icons,function(a,e){t("#"+s+" .wptsFA-icons").append('<i class="fa fa-'+e.id+'"></i>')})}),t(this).length>0&&t("#"+s+" .wptsFA-icon").html('<i class="fa '+t(this).val()+'"></i>'),t("#"+s).click(function(){t(this).toggleClass("active")}),t(document).on("click","#"+s+" .wptsFA-icons > i",function(){var a=t(this).attr("class").replace("fa","");t(e).val(a),t("#"+s+" .wptsFA-icon").html('<i class="fa '+a+'"></i>')})})}}(a)}).call(t,e(0))}});