"use strict";
/**
*    Declaration of your module
*    @params modulename and undefined
**/
var MyAssignmentsController = function(theSettings) { 
    
    let published = {};
    
    published.init = function(){
    	let assignmentBtn = document.querySelectorAll(".deliver-assignment");
    	assignmentBtn.forEach(function(btn){
    	    btn.addEventListener('click',function(e) {
        	    e.preventDefault();
                send(this.getAttribute('data-assignment'));
                
                return false;
            });    
    	})
    	
    }
    
    function send(assignmentId){
	    
		var thedata = {
		    action: 'deliver_project',
			assignment: assignmentId
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
			            window.location.reload();
			        }
			        else
			        {
			            alert(response.msg);
			        }
			    }
	 	    }
	 	});
	 	
	 	return false;
    }
    
    return published;
}