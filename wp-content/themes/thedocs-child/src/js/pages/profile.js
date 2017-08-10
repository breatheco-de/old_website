import {BCMessaging} from '../breathecode/module/messaging';
/**
*    Declaration of your module
*    @params modulename and undefined
**/
export default class UserCohort{ 

    init(){
    	
    	this.badges = [];
    	 
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
    	
        document.querySelectorAll('.badg-img').forEach(elm => {
            elm.addEventListener("mouseenter",evt => this.getPopoverContent(evt));
            //elm.addEventListener("mouseout",evt => this.hidePopover(evt));
        });
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
    
    hidePopover(e){
        if (e.target.classList.contains('single-badge')) $(e.target).popover('hide');
    }
    
    getPopoverContent(e){
        //console.log(e);
        
        var badgeArrray = this.badges;
        let badgeId = $(e.target).data('slug');
        if(typeof badgeId === 'undefined') return;
        
        if(typeof badgeArrray[badgeId] !== 'undefined'){
        
            document.querySelectorAll('.badg-img').forEach(elm => { 
                if(elm == e.target){
                    $(e.target.parentNode).popover('show');
                } 
                else $(elm.parentNode).popover('hide'); 
            });
            return badgeArrray[badgeId];
        }
        else{
            badgeArrray[badgeId] = { description: 'Loading...' };
            
            $(e.target.parentNode).popover({ 
                placement: function (context, source) {
                    var position = $(e.target.parentNode).position();
            
                    if (position.left > 515) {
                        return "left";
                    }
            
                    if (position.left < 515) {
                        return "right";
                    }
            
                    if (position.top < 110){
                        return "bottom";
                    }
            
                    return "top";
                },
                content: function(){ 
                    return badgeArrray[badgeId].description;
                }
            }).popover('show');
            
            
            $.ajax({
                url: WPAS_APP.ajax_url, 
                method: 'GET',
                data: { action: 'get_badge', badge: badgeId}, 
                success: function(response) {
                    
                    if(response.code==200){
                        badgeArrray[badgeId] = response.data;
                        document.querySelectorAll('.badg-img').forEach(elm => { 
                            if(elm == e.target){
                                $(e.target.parentNode).popover('show');
                            }
                            else $(elm.parentNode).popover('hide'); 
                        });
                    }
                    else  BCMessaging.notify(BCMessaging.ERROR,response.msg);
                }
            });
        }
    }
    
}