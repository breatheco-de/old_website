"use strict";
/**
*    Declaration of your module
*    @params modulename and undefined
**/
export default class MyTalents{ 

    init(){
        //this function initialize your module
        if(typeof WPAS_APP.badges === 'undefined') this.getAllBadges();
        else this.refreshBadges(WPAS_APP.badges);
    }
    
    getAllBadges(){
    
        ajax.get(WPAS_APP.host+'badges/', {}, function(response) {
            if(response.code==200){
                this.refreshBadges(response.data);
            }
            else alert(response.msg);
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
    
};