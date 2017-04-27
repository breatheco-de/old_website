"use strict";

(function(browserChecker,$,undefined) { 

	let browsers = ['chrome','firefox','edge','safary'];

	browserChecker.init = function(theSettings){

		if(theSettings && theSettings['browsers']) browsers = theSettings['browsers'];
		let currentBrowser = getBrowser();
		if(browsers.indexOf(currentBrowser)<0) promt(currentBrowser);
	}

	function promt(currentBrowser)
	{
		let dialogHTML = '<div id="browserModal" class="modal fade browserChecker" tabindex="-1" role="dialog">'+
					  '<div class="modal-dialog" role="document">'+
					    '<div class="modal-content">'+
					      '<div class="modal-body text-center">'+
					        '<h3>Whoops!</h3>'+
					        '<p>${msg}</p>'+
					        '<p><i class="fa fa-chrome fa-6" aria-hidden="true"></i></p>'+
					        '<a type="button" class="btn btn-lg btn-default browserChecker-close" data-dismiss="modal">Close</a>'+
					      '</div>'+
					    '</div><!-- /.modal-content -->'+
					  '</div><!-- /.modal-dialog -->'+
					'</div><!-- /.modal -->';

		$.template( "currentBrowserTemplate", dialogHTML );
		$.tmpl( "currentBrowserTemplate", { 
			browser: currentBrowser,
			msg: "The BreatheCode platform is best experienced in Chrome, you can continue browsing if you like but be advised that some features could be blocked or malfunctioning"
		} ).appendTo( "body" );

		let x = readCookie('browserChecker_modal_shown')
		if (!x) {
			createCookie('browserChecker_modal_shown',true,1);
			$('#browserModal').modal();
		}
	}

	function getBrowser(){
		// Opera 8.0+
		var isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
		if(isOpera) return 'opera';
		// Firefox 1.0+
		var isFirefox = typeof InstallTrigger !== 'undefined';
		if(isFirefox) return 'firefox';
		// Safari 3.0+ "[object HTMLElementConstructor]" 
		var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || safari.pushNotification);
		if(isSafari) return 'safari';
		// Internet Explorer 6-11
		var isIE = /*@cc_on!@*/false || !!document.documentMode;
		if(isIE) return 'exporer';
		// Edge 20+
		var isEdge = !isIE && !!window.StyleMedia;
		if(isEdge) return 'edge';
		// Chrome 1+
		var isChrome = !!window.chrome && !!window.chrome.webstore;
		if(isChrome) return 'chrome';

		return 'uknown';
	}

	function createCookie(name,value,days) {
	    var expires = "";
	    if (days) {
	        var date = new Date();
	        date.setTime(date.getTime() + (days*24*60*60*1000));
	        expires = "; expires=" + date.toUTCString();
	    }
	    document.cookie = name + "=" + value + expires + "; path=/";
	}

	function readCookie(name) {
	    var nameEQ = name + "=";
	    var ca = document.cookie.split(';');
	    for(var i=0;i < ca.length;i++) {
	        var c = ca[i];
	        while (c.charAt(0)==' ') c = c.substring(1,c.length);
	        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	    }
	    return null;
	}

	function eraseCookie(name) {
	    createCookie(name,"",-1);
	}

})( window.browserChecker = window.browserChecker || {}, jQuery );