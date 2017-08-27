export var BCMessaging = (function(){
    
    var _public = {};
    _public.ERROR = 'danger';
    _public.WARNING = 'warning';
    _public.SUCCESS = 'success';
    var notificationContainer = null;
    
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
        if(!notificationContainer) createNotificationContainer(position);
        
        appendNotification(notification);
    }
    
    function appendNotification(notification){
        
        var singleNotification = document.createElement('div');
        singleNotification.classList.add('single-notification');
        singleNotification.innerHTML = getTemplate()(notification.type, notification.message);
        
        notificationContainer.appendChild(singleNotification);
        
        var nodeChilds = singleNotification.childNodes;
        for (var i = 0; i < nodeChilds.length; i++) {
            if (nodeChilds[i].className == "close") {
                nodeChilds[i].addEventListener('click',function(){
                    notificationContainer.removeChild(singleNotification);
                });
              break;
            }        
        }
        
        setTimeout(function () {
            singleNotification.classList.add('about-to-close');
            setTimeout(function () {
                notificationContainer.removeChild(singleNotification);
                if(notificationContainer.childNodes.length==0) deleteNotificationContainer();
            }, 500);
                
        }, 3000);
    }
    
    function createNotificationContainer(position){
        
        notificationContainer = document.createElement('div');
        notificationContainer.classList.add('bcnotification');
        notificationContainer.classList.add(position+'-notification');
        document.body.appendChild(notificationContainer);
        
    }
    
    function deleteNotificationContainer(){
        if(notificationContainer)
        {
            notificationContainer.parentNode.removeChild(notificationContainer);
            notificationContainer = null;
        }
    }
    
    function getTemplate(){
        return (type, message) => `<div class="inner-message alert alert-${type}">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    ${message}
                                </div>`;
    }
    
    return _public;
    
})();