import {BCMessaging} from '../breathecode/module/messaging';
/**
*    Declaration of your module
*    @params modulename and undefined
**/
export default class UserCohort{ 

    init(){
    	
    	document.querySelector('#class_attendancy .send-btn').addEventListener("click", btn => {
            var list = {};  
            var cohort = 0;
    	    $(".attendants").each(function(){
                if($(this).prop('checked')) list[$(this).val()] = $('#student'+$(this).val()).val();
                else list[$(this).val()] = false;
                
                cohort = $(this).data('cohort');
            });
            
            this.sendAttendancy(cohort, list);
    	});
    	document.querySelector('#update_repls .send-btn').addEventListener("click", btn => {
            var repls = {};    	   
            var cohort = 0;
    	    $("#update_repls input").each(function(elm){
                repls[$(this).attr('id')] = $(this).val();
                cohort = $(this).data('cohort');
            });
            
            this.updateReplits(cohort,repls);
    	});
    }
    
    sendAttendancy(cohort, list){
	    console.log(list);
		var thedata = {
		    action: 'check_attendancy',
		    cohort_id: cohort,
			attendants: list
		};
		// the_ajax_script.ajaxurl is a variable that will contain the url to the ajax processing file
	 	$.ajax({
	 		url: WPAS_APP.ajax_url,
	 		data: thedata,
	 		method: 'POST',
	 		success: response => {
			    if(response){
			        if(response.code=='200')
			        {
			            console.log(response);
			        }
			        else
			        {
			            BCMessaging.notify(BCMessaging.ERROR,response.msg);
			        }
			    }
	 		}
	 	});
	 	
	 	return false;
    }
    
    updateReplits(cohort, replits){
		var thedata = {
		    action: 'update_replits',
			repls: replits,
			cohort_id: cohort
		};
		// the_ajax_script.ajaxurl is a variable that will contain the url to the ajax processing file
	 	$.ajax({
	 		url: WPAS_APP.ajax_url,
	 		data: thedata,
	 		method: 'POST',
	 		success: response => {
			    if(response){
			        if(response.code=='200')
			        {
			            console.log(response);
			        }
			        else
			        {
			             BCMessaging.notify(BCMessaging.ERROR,response.msg);
			        }
			    }
	 	    }
	 	});
	 	
	 	return false;
    }
    
}