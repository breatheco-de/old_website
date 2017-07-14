"use strict";
/**
*    Declaration of your module
*    @params modulename and undefined
**/
var MyTalents = function(theSettings) { 

    let published = {};

    published.init = function(){
        //this function initialize your module
        if(!theSettings) theSettings = {};
        if(!theSettings.host) theSettings.host = 'https://talenttree-alesanchezr.c9users.io/';
        
        if(!theSettings.badges) getAllBadges();
        else refreshBadges(theSettings.badges);
    }
    
    function getAllBadges(){
    
        ajax.get(theSettings.host+'badges/', {}, function(response) {
            if(response.code==200){
                refreshBadges(response.data);
            }
            else alert(response.msg);
        });
    }
    
    function refreshBadges(badgesData){
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
    
    return published;
    
};