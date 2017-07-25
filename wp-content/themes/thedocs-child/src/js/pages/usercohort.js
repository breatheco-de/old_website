"use strict";
/**
*    Declaration of your module
*    @params modulename and undefined
**/
export default class UserCohort{ 

    init(){
    	document.querySelector('#class_attendancy .send-btn').addEventListener("click", btn => {
            let list = [];    	   
    	    $(".attendants").each(function(){
                list.push($(this).val());
            });
            
            this.sendAttendancy(list);
    	});
    }
    
    sendAttendancy(list){
	    
		var thedata = {
		    action: 'check_attendancy',
			attendants: list
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
			            console.log(response);
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