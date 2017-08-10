export var BCSearch = (function(){
    
    var _public = {};
    var searchInput, searchMode, postType;
    var listening = false;
    
    _public.init = function(mode){
        searchInput = document.querySelector(".search-top-bar .search-box");
        searchInput.addEventListener('focus',startListeningSearch);
        changeMode(mode);
        
        var radios = document.querySelectorAll('.search-mode .btn');
        radios.forEach(elm => {
            elm.addEventListener('click', function(e) {
                changeMode(this.childNodes[1].value);//get the radio button (is always the second child)
            });
        });
    }
    
    function startListeningSearch(e){
        
        if(!listening) searchInput.addEventListener('keypress', function(e){
            if (e.keyCode == 13) {
                if(searchInput.value != '') window.location = '/?s='+searchInput.value+'&post_type='+getPostType(searchMode);
            }
        });
        listening = true;
    }
    
    function changeMode(mode){
        searchMode = mode;
        document.querySelector('.search-mode input[type=radio]').classList.remove('active');
        var activeBtn = document.querySelector('.search-mode input[value='+mode+'] ')
        activeBtn.parentNode.classList.add('active');
        searchInput.placeholder = 'Search '+mode;
    }
    
    function getPostType(mode){
        switch(mode){
            case 'lessons':
                return 'lesson';
            break;
            case 'assets':
                return 'lesson-asset';
            break;
            default:
                return '';
            break;
        }
    }
    
    return _public;
    
})();