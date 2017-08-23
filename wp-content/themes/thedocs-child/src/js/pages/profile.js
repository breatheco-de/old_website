import {BCMessaging} from '../breathecode/module/messaging';
import {BadgesManager} from '../breathecode/module/badges';
/**
*    Declaration of your module
*    @params modulename and undefined
**/
export default class UserCohort{ 

    init(){
    	
    	document.querySelector('#modal-update_profile .send-btn').addEventListener("click", btn => {
            let firstname = $('#firstname').val();
            let lastname = $('#lastname').val();
            let github = $('#github').val();
            let phonenumber = $('#phonenumber').val();
            let bio = $('#bio').val();
            /*
            if(!validator.isURL(github) || github.length==0) BCMessaging.addMessage(BCMessaging.ERROR,'The github URL must be a valid URL');
            
            let messages = BCMessaging.getMessages(BCMessaging.ERROR);
            if(messages.length>0) BCMessaging.notifyPending(BCMessaging.ERROR);
            else this.deliverAssignment(assignmentId,github);
            */
            this.updateProfile({
    		    action: 'update_profile',
    			firstname: firstname,
    			lastname: lastname,
    			github: github,
    			phonenumber: phonenumber,
    			bio: bio
		    });
    	});
    	
        BadgesManager.init('.badg-img');
    }
    

    updateProfile(thedata){
	    
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
    
	refreshBadges(badgesData){
        let badgesLi = document.querySelectorAll('.talent-badge li');
        console.log(badgesLi);
        badgesLi.forEach(function(auxBadge){
            let badge = badgesData.find(function(item){ if(item.slug == auxBadge.getAttribute('data-slug')) return auxBadge; });
            let childs = auxBadge.childNodes;
            childs.forEach(function(elm){
                console.log(elm);
                //if the badge has a real URL
                if(elm.classList && badge.url && badge.url != '' && elm.classList.contains('avatar')) elm.style.backgroundUrl = "url('"+badge.url+"')";
                
                //If the badge has a name
                if(elm.classList && badge.name && badge.name != '' && elm.classList.contains('badge-name')) elm.innerHTML = badge.name;
            });
        });
        
    }
    
}