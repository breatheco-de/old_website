import {BCMessaging} from '../breathecode/module/messaging';
/**
*    Declaration of your module
*    @params modulename and undefined
**/
export default class project{
    
    constructor(){
        //any properties here using this.propertyName
        $('#content1').css('display','block');
        $(".github-tabs").click(function(){
            $(this).parent().siblings().css('display','none');
            $(this).parent().siblings('#'+$(this).attr('for')).css("display","block");
        });
        
        $('.markdown-body a').attr('target', '_blank');
    }
    
    init(){
        
            
        
    }
    
}