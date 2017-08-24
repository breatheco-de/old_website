import {BCMessaging} from '../breathecode/module/messaging';
import validator from 'validator';
import {BadgesManager} from '../breathecode/module/badges';
/**
*    Declaration of your module
*    @params modulename and undefined
**/
export default class StudentProfile{ 
    
    init(){
    	this.badges = [];
    	
    	document.querySelector('#modal-enable_quiz .send-btn').addEventListener("click", btn => {
            let quizSlug = $('#quiz-select').val();
            let studentId = $('#student-id').val();
            /*
            if(!validator.isURL(github) || github.length==0) BCMessaging.addMessage(BCMessaging.ERROR,'The github URL must be a valid URL');
            
            let messages = BCMessaging.getMessages(BCMessaging.ERROR);
            if(messages.length>0) BCMessaging.notifyPending(BCMessaging.ERROR);
            else this.deliverAssignment(assignmentId,github);
            */
            this.sendForm({
    		    action: 'enable_quiz',
    			quiz: quizSlug,
    			student: studentId
		    });
    	});
    	
    	document.querySelector('#modal-give_badge_points .send-btn').addEventListener("click", btn => {
            let badgeId = $('#badges').val();
            let studentId = $('#student-id').val();
            let points = $('#points-given').val();
            
            if(!validator.isNumeric(points) || parseInt(points)==0) BCMessaging.addMessage(BCMessaging.ERROR,'You need to specify the number of points you want to give');
            if(validator.isEmpty(badgeId) || parseInt(badgeId)==0) BCMessaging.addMessage(BCMessaging.ERROR,'Please select a badge');
            
            let messages = BCMessaging.getMessages(BCMessaging.ERROR);
            if(messages.length>0) BCMessaging.notifyPending(BCMessaging.ERROR);
            else{
                this.sendForm({
        		    action: 'give_points',
        			badge: badgeId,
        			student: studentId,
        			points: points
    		    });
            }
    	});
    	
    	document.querySelector('#give-points').addEventListener("click", btn => {
    	    
    	    if(this.badges && this.badges.length>0) this.fillModalWithBadges();
	        else this.getBadges();
	        
    	});
    	
        BadgesManager.init('.badg-img');
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
    
    getBadges(){
	    
		// the_ajax_script.ajaxurl is a variable that will contain the url to the ajax processing file
	 	$.ajax({
	 	    url: WPAS_APP.ajax_url,
	 	    method: 'get',
	 	    dataType: "json",
	 	    data: { action: 'get_all_badges' }, 
	 	    success: response => {
			    if(response){
			        if(response.code=='200')
			        {
			            if(response.data && response.data.length>0)
			            {
			                this.badges = response.data;
			                this.fillModalWithBadges();
			                
			                var badgesSelect = document.querySelector('#badges');
			                badgesSelect.addEventListener('change', evt => {
			                    
			                    var badge = this.getSingleBadge(evt.target.value);
			                    if(badge)
			                    {
			                        document.querySelector('.second-part').classList.remove('hide');
			                        document.querySelector("#badge-image").src = 'https://api.breatheco.de'+badge.image_url;
			                        document.querySelector("#badge-title").innerHTML = this.htmlEntities(badge.name);
			                        document.querySelector("#badge-description").innerHTML = this.htmlEntities(badge.description);
			                        
			                    }
			                });
			            }

			        }
			        else
			        {
			        	BCMessaging.notifyPending(BCMessaging.ERROR,response.msg);
			        }
			    }
	 	    }
	 	});
	 	
    }
    
    fillModalWithBadges(){
        var badgesSelect = document.querySelector('#badges');
        badgesSelect.innerHTML = '<option value="0">Select a badge</option>';
        
        this.badges.forEach(badge => {
            var option = document.createElement("option");
            option.text = badge.name;
            option.value = badge.slug;
            badgesSelect.add(option);
        });
    }
    
    getSingleBadge(slug){
        for (var i = 0; i < this.badges.length; i++) {
          if(this.badges[i].slug == slug) return this.badges[i];
        }
        
        return null;
    }
    
    htmlEntities(str) {
        return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }
    
}