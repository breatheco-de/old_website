"use strict";
/**
*    Declaration of your module
*    @params modulename and undefined
**/
export default class MyAssignments{ 

    init(GLOBALS){
    	
    	this.notifier = GLOBALS.notifier;
    	
    	let assignmentBtn = document.querySelectorAll(".deliver-assignment");
    	assignmentBtn.forEach(function(btn){
    	    btn.addEventListener('click',e => {
        	    e.preventDefault();
        	    
        	    let assignmentId = e.target.getAttribute('data-assignment');
        	    let assignmentTitle = e.target.getAttribute('data-assignment-title');
        	    document.querySelector('#assignment-title').value=assignmentTitle;
        	    document.querySelector('#assignment').value=assignmentId;
                
                return false;
            });    
            
    	});

    	document.querySelector('#modal-deliver_assignment .send-btn').addEventListener("click", btn => {
            let assignmentId = $('#assignment').val();
            let github = $('#github').val();
            
            this.deliverAssignment(assignmentId,github);
    	});
    }
    
    deliverAssignment(assignmentId, github_url){
	    
		var thedata = {
		    action: 'deliver_project',
			assignment: assignmentId,
			github: github_url
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
			            window.location = response.data;
			        }
			        else
			        {
			        	this.notifier.notify(this.notifier.ERROR,response.msg);
			        }
			    }
	 	    }
	 	});
	 	
	 	return false;
    }
    
}