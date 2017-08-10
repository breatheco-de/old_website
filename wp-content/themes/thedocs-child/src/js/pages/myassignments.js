import validator from 'validator';
import {BCMessaging} from '../breathecode/module/messaging';
/**
*    Declaration of your module
*    @params modulename and undefined
**/
export default class MyAssignments{ 

    init(){
    	
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
            
            let isURL = validator.isURL(github);
            if(!isURL || github.length==0) BCMessaging.addMessage(BCMessaging.ERROR,'The github URL must be a valid URL');
            
            let messages = BCMessaging.getMessages(BCMessaging.ERROR);
            if(messages.length>0) BCMessaging.notifyPending(BCMessaging.ERROR);
            else this.deliverAssignment(assignmentId,github);
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
			            window.location.reload();
			        }
			        else
			        {
			        	BCMessaging.notify(BCMessaging.ERROR,response.msg);
			        }
			    }
	 	    }
	 	});
	 	
    }
    
}