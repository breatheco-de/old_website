import {BCMessaging} from '../breathecode/module/messaging';
/**
*    Declaration of your module
*    @params modulename and undefined
**/
export default class MyTalents{ 

    init(){
        
        this.badges = [];
        //this function initialize your module
        //if(typeof WPAS_APP.badges === 'undefined') this.getAllBadges();
        //else this.refreshBadges(WPAS_APP.badges);
        document.querySelectorAll('.talent-badge li').forEach(elm => {
            elm.addEventListener("mouseenter",evt => this.getPopoverContent(evt));
            elm.addEventListener("mouseout",evt => this.hidePopover(evt));
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
        
            $(e.target).popover({content: badgeArrray[badgeId].description}).popover('show');
            return badgeArrray[badgeId];
        }
        else{
            $.ajax({
                url: WPAS_APP.ajax_url, 
                method: 'GET',
                data: { action: 'get_badge', badge: badgeId}, 
                success: function(response) {
                    if(response.code==200){
                        badgeArrray[badgeId] = response.data;
                        $(e.target).popover({content: badgeArrray[badgeId].description}).popover('show');
                    }
                    else  BCMessaging.notify(BCMessaging.ERROR,response.msg);
                }
            });
        }
    }
    
};