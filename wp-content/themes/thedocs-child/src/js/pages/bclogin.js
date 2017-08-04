/**
*    Declaration of your module
*    @params modulename and undefined
**/
export default class bclogin{
    
    constructor(){
        this.errorAlert = '.alert-danger';
    }
    
    init(){
    	document.querySelector(".form-signin").addEventListener('submit',e => {
    	    e.preventDefault();
    	    
            if(this.validateLogin()) this.login();
            
            return false;
        });
    }
    
    validateLogin(){
        let userVal = document.querySelector('#username').value;
        let passVal = document.querySelector('#password').value;
        
        if(userVal && passVal) return true;
    }
    
    login(){
        let userVal = document.querySelector('#username').value;
        let passVal = document.querySelector('#password').value;
        
        this.send(userVal,passVal);
    }
    
    showError(msg){
        let errorContainer = document.querySelector(this.errorAlert);
        errorContainer.innerHTML = msg;
        errorContainer.style.display = 'block';
        
        let loginBtn = document.querySelector('#login');
        loginBtn.disabled = false
        loginBtn.innerHTML = 'Sign In';
        loginBtn.classList.add('btn-primary');
    }
    
    hideError(){
        let errorContainer = document.querySelector(this.errorAlert);
        errorContainer.innerHTML = '';
        errorContainer.style.display = 'none';
        
        let loginBtn = document.querySelector('#login');
        loginBtn.disabled = false;
        loginBtn.innerHTML = 'Loading...';
        loginBtn.classList.remove('btn-primary');
    }

    send(userVal,passVal){
	    
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
	 	    success: response => {
			    if(response){
			        if(response.code=='200')
			        {
			            window.location.href = response.data;
			        }
			        else
			        {
			            this.showError(response.msg);
			        }
			    }
	 	    }
	 	});
	 	
	 	return false;
    }
    
}