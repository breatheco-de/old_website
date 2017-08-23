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
        
        $(".down-lesson-icon").click(function() {
            $('html,body').animate({
                scrollTop: $(this).offset().top
                
            },'slow');
        });
    }
    
    init(){
        
            
        
    }
    
}