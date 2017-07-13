"use strict";
/**
*    Declaration of your module
*    @params modulename and undefined
**/
var ReviewAssignmentsController = function(theSettings) { 
    
    let published = {};
    
    published.init = function(){
    	let assignmentBtn = document.querySelector("#new-assignment");
    	assignmentBtn.addEventListener('click',function(){
    	    
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
    
    return published;
}