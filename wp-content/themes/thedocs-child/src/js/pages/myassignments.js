"use strict";
/**
*    Declaration of your module
*    @params modulename and undefined
**/
export default class MyAssignments{ 

    init(){
    	let assignmentBtn = document.querySelectorAll(".deliver-assignment");
    	assignmentBtn.forEach(function(btn){
    	    btn.addEventListener('click',function(e) {
        	    e.preventDefault();
                this.send(this.getAttribute('data-assignment'));
                
                return false;
            });    
    	})
    	
    }
    
    send(assignmentId){
	    
		var thedata = {
		    action: 'deliver_project',
			assignment: assignmentId
		};
		// the_ajax_script.ajaxurl is a variable that will contain the url to the ajax processing file
	 	$.ajax({
	 	    url: WPAS_APP.ajax_url,
	 	    method: 'post',
	 	    dataType: "json",
	 	    data: thedata, 
	 	    success: function(response) {
			    if(response){
			        if(response.code=='200')
			        {
			            window.location = response.data;
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
    
}