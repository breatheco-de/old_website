export var BCMessaging = (function(){
    
    var _public = {};
    _public.ERROR = 'danger';
    var messages = [];
    
    _public.addMessage = function(type, message){
        
        if(typeof messages[type] == 'undefined') messages[type] = [];
        messages[type].push(message);
    }
    
    _public.getMessages = function(type){
        
        if(typeof messages[type] == 'undefined') messages[type] = [];
        return messages[type];
    }
    
    _public.notify = function(type, message){
        
        showNotification('top',{
            type: type,
            message: message
        })
    }
    
    _public.notifyPending = function(type, messagesArray=null){
        
        let content = '<ul>';
        if(!messagesArray) messages[type].forEach(msg => { content += `<li>${msg}</li>`; });
        else messagesArray.forEach(msg => { content += `<li>${msg}</li>`; });
        content += '</ul>';
        
        messages[type] = [];
        
        showNotification('top',{
            type: type,
            message: content
        })
    }
    
    function showNotification(position, notification){
        
        var notifyContent = document.createElement('div');
        notifyContent.classList.add('bcnotification');
        notifyContent.classList.add(position+'-notification');
        notifyContent.innerHTML = getTemplate()(notification.type, notification.message);
        document.body.appendChild(notifyContent);
        
        let classNames = '';
        notifyContent.classList.forEach(elm => { classNames += '.'+elm; })
        document.querySelector(classNames+' .close').addEventListener('click',function(){
            document.body.removeChild(notifyContent);
        });
        
        setTimeout(function () {
            document.body.removeChild(notifyContent);
        }, 3000);
    }
    
    function getTemplate(){
        return (type, message) => `<div>
                                <div class="inner-message alert alert-${type}">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    ${message}
                                </div>
                            </div>`;
    }
    
    return _public;
    
})();