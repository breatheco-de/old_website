import {BCMessaging} from '../breathecode/module/messaging';
/**
*    Declaration of your module
*    @params modulename and undefined
**/
export default class UserCohort{ 

    init(){
    	
    	document.querySelector('#slack-url').addEventListener('focusout', evt => {
    	
    		var slackURL = evt.target.value;
    		var cohort = evt.target.getAttribute("data-cohort");
    		
			var thedata = {
			    action: 'save_slack_url',
			    cohort_id: cohort,
				slack: slackURL
			};
			
			this.sendForm(thedata, obj => {
				$(evt.target).closest('.input-group').append('<span class="glyphicon glyphicon-ok inside" style="color:green;"></span>');
				setTimeout(function(){
					
					var validCheck = document.querySelector('.input-group .glyphicon.inside'); 
					validCheck.parentNode.removeChild(validCheck);
					
				}, 2000)
			});
    	});
    	
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

		var thedata = {
		    action: 'check_attendancy',
		    cohort_id: cohort,
			attendants: list
		};
		
		this.sendForm(thedata);
	 	
	 	return false;
    }
    
    updateReplits(cohort, replits){
		var thedata = {
		    action: 'update_replits',
			repls: replits,
			cohort_id: cohort
		};
		// the_ajax_script.ajaxurl is a variable that will contain the url to the ajax processing file
	 	this.sendForm(thedata);
	 	
	 	return false;
    }
    
    sendForm(thedata, successCallback=null){
	 	$.ajax({
	 		url: WPAS_APP.ajax_url,
	 		data: thedata,
	 		method: 'POST',
	 		success: response => {
			    if(response){
			        if(response.code=='200')
			        {
			            if(!successCallback) window.location.reload();
			            else successCallback();
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