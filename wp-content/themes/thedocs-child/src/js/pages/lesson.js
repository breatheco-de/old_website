import {BCMessaging} from '../breathecode/module/messaging';
import {BackgroundManager} from '../breathecode/module/background';
/**
*    Declaration of your module
*    @params modulename and undefined
**/
export default class lesson{
    
    constructor(){
        //any properties here using this.propertyName
        BackgroundManager.init('large-header','demo-canvas');
        
        $('.affixed-topbar').affix({
            offset: {
                top: 300
              }
        });
        
        $(".start-lesson-icon").click(function() {
            $('html,body').animate({
                scrollTop: $('.lesson-navegation').offset().top
                
            },'slow');
        });
    }
    
    init(){
        
            
        
    }
    
}