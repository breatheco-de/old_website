"use strict";
/**
*    Declaration of your module
*    @params modulename and undefined
**/
var bcloginController = function(theSettings) { 
    
    let published = {},
        errorAlert = '.alert-danger';
    
    published.init = function(){
    	document.querySelector(".form-signin").addEventListener('submit',function(e) {
    	    e.preventDefault();
    	    
            if(validateLogin()) login();
            
            return false;
        });
    }
    
    function validateLogin(){
        let userVal = document.querySelector('#username').value;
        let passVal = document.querySelector('#password').value;
        
        if(userVal && passVal) return true;
    }
    
    function login(){
        let userVal = document.querySelector('#username').value;
        let passVal = document.querySelector('#password').value;
        
        send(userVal,passVal);
    }
    
    function showError(msg){
        let errorContainer = document.querySelector(errorAlert);
        errorContainer.innerHTML = msg;
        errorContainer.style.display = 'block';
        
        let loginBtn = document.querySelector('#login');
        loginBtn.disabled = false
        loginBtn.innerHTML = 'Sign In';
        loginBtn.classList.add('btn-primary');
    }
    
    function hideError(){
        let errorContainer = document.querySelector(errorAlert);
        errorContainer.innerHTML = '';
        errorContainer.style.display = 'none';
        
        let loginBtn = document.querySelector('#login');
        loginBtn.disabled = false;
        loginBtn.innerHTML = 'Loading...';
        loginBtn.classList.remove('btn-primary');
    }

    function send(userVal,passVal){
	    
	    hideError();
	    
		var thedata = {
		    action: 'custom_login',
			username: userVal,
			password: passVal
		};
		// the_ajax_script.ajaxurl is a variable that will contain the url to the ajax processing file
	 	$.ajax({
	 	    url: theSettings.ajaxurl,
	 	    method: 'post',
	 	    dataType: "json",
	 	    data: thedata, 
	 	    success: function(response) {
			    if(response){
			        if(response.code=='200')
			        {
			            window.location.href = response.data;
			        }
			        else
			        {
			            showError(response.msg);
			        }
			    }
	 	    }
	 	});
	 	
	 	return false;
    }
    
    return published;
}