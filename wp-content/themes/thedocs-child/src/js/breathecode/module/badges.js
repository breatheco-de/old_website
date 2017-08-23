import {BCMessaging} from './messaging';

export var BadgesManager = (function(){
    
    var publicScope = {};
    var _badges = [];
    var _badgesClass = '';
    var _cancelHide = false;
    
    publicScope.init = function(badgesClass){
        
        _badgesClass = badgesClass;
        
        document.querySelectorAll(_badgesClass).forEach(elm => {
            elm.addEventListener("mouseenter",evt => getPopoverContent(evt));
            elm.addEventListener("mouseout",evt => hidePopover(evt));
        });
    }
    
    function hidePopover(e){
        _cancelHide = false;
        document.querySelectorAll(_badgesClass).forEach(elm => { 
            if(!_cancelHide) $(elm.parentNode).popover('hide'); 
        });
    }
    
    function getPopoverContent(e){
        //console.log(e);
        _cancelHide = true;
        var badgeArrray = _badges;
        let badgeId = $(e.target).data('slug');
        if(typeof badgeId === 'undefined') return;
        
        if(typeof badgeArrray[badgeId] !== 'undefined'){
        
            document.querySelectorAll(_badgesClass).forEach(elm => { 
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
                        document.querySelectorAll(_badgesClass).forEach(elm => { 
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
    
    return publicScope;
    
})();