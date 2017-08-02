"use strict";
/**
*    Declaration of your module
*    @params modulename and undefined
**/
export default class ReviewAssignments{  
    
    init(){
    	document.querySelector('#modal_new-assignment .send-btn').addEventListener("click", btn => {
            let cohortId = $('#cohort').val();
            let templateId = $('#atemplate-select').val();
            let duedate = $('#duedate').val();
            this.createAsignment(cohortId,duedate,templateId);
    	});
    	
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
    
    createAsignment(cohortId,duedate,templateId){
	    
		var thedata = {
		    action: 'create_new_assignment',
			cohort_id: cohortId,
			duedate: duedate,
			template_id: templateId
		};
		// the_ajax_script.ajaxurl is a variable that will contain the url to the ajax processing file
	 	$.ajax({
	 	    url: WPAS_APP.ajax_url,
	 	    method: 'post',
	 	    dataType: "json",
	 	    data: thedata, 
	 	    success: function(response) {
	 	    	console.log(response);
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