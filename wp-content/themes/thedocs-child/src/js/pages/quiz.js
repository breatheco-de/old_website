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
                    var studentId = document.querySelector('#student').value;
                    var quizId = document.querySelector('#quiz').value;
                    var badges = document.querySelectorAll('.single-badge');
                    
                    if(event.data.started){
                        this.sendForm({ action: 'save_attempt', student: studentId, quiz: quizId },function(){
                            window.location.reload();
                        });
                    }else{
                        var percentage = Math.floor((event.data.passedQuestions/event.data.totalQuestions) * 100);
                        if(percentage>75)
                        {
                            badges.forEach(function(badgeElm){
                                
                                var badgeId = badgeElm.getAttribute("data-slug");
                                var points = badgeElm.getAttribute("data-points");
                                
                                this.sendForm({
                        		    action: 'give_points',
                        			badge: badgeId,
                        			student: studentId,
                        			points: points
                		        }, function(){ 
                		            
                		            BCMessaging.notify(BCMessaging.SUCCESS,"Poins for "+badgeId+" given successfully."); 
                		            
                		        });
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
    
    sendForm(thedata, success=null){
	    
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
			            if(success) success();
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