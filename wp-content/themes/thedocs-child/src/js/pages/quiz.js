import {BCMessaging} from '../breathecode/module/messaging';
import {BadgesManager} from '../breathecode/module/badges';
/**
*    Declaration of your module
*    @params modulename and undefined
**/
export default class quiz{
    
    constructor(){
        //any properties here using this.propertyName
    }
    
    init(){
        
            BadgesManager.init('.badg-img');
        
            window.addEventListener('message', event => { 
                    
                // IMPORTANT: Check the origin of the data! 
                if (~event.origin.indexOf('https://assets.breatheco.de')) { 
                    // The data has been sent from your site 
                    console.log(event.data); 
                    
                    if(event.data.started){
                        this.save_attempt();
                    }else{
                        var percentage = Math.floor((event.data.passedQuestions/event.data.totalQuestions) * 100);
                        if(percentage>75)
                        {
                            this.sendForm({
                    		    action: 'give_points',
                    			badge: badgeId,
                    			student: studentId,
                    			points: points
                		    });
                        }
                    }
                    // The data sent with postMessage is stored in event.data 
                } else { 
                    // The data hasn't been sent from your site! 
                    // Be careful! Do not use it. 
                    return; 
                } 
            }); 
            
        
    }
    
    save_attempt(){
        
        var studentId = document.querySelector('#student').value;
        var quizId = document.querySelector('#quiz').value;
        
        $.ajax({
                url: WPAS_APP.ajax_url, 
                method: 'POST',
                data: { action: 'save_attempt', student: studentId, quiz: quizId}, 
                success: function(response) {
                    
                    if(response.code==200){
                    }
                    else  BCMessaging.notify(BCMessaging.ERROR,response.msg);
                }
            });
    }
    
    sendForm(thedata){
	    
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
			        	BCMessaging.notifyPending(BCMessaging.ERROR,response.msg);
			        }
			    }
	 	    }
	 	});
	 	
    }
}