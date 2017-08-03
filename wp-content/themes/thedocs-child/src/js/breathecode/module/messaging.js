export function BCMessaging(){
    
    var _public = {};
    _public.ERROR = 'danger';
    
    _public.notify = function(type, message){
        let template = getTemplate('top');
        document.querySelector('body').innerHTML += template(type, message);
    }
    
    function getTemplate(templateName){
        switch(templateName)
        {
            case "top":
                return (type, message) => `<div class="bcnotification top-notification">
                            <div>
                                <div class="inner-message alert alert-${type}">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    ${message}
                                </div>
                            </div>
                        </div>`;
            break;
        }
    }
    
    return _public;
    
}