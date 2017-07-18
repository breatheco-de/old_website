require('./vendor/mfb');
require('./breathecode/module/ajax');

//Require the styles of the app
require('../scss/style.scss')

jQuery(document).ready(function(){
    
    $('[data-toggle="tooltip"]').tooltip(); 
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $(".sidebar-boxed").toggleClass("toggled");
    });

    if(typeof browserChecker!== 'undefined')
    {
       browserChecker.init({ 
       		browsers: ['chrome']
    	});
    }
    
    if(typeof(WPAS_APP) !== 'undefined' && WPAS_APP.wpas_controller)
    {
        System.import('./pages/' + WPAS_APP.wpas_controller.toLowerCase()).then(Controller => {
            var c = new Controller.default();
            c.init();
        }, function(error) {
          alert(error.name + ': ' + error.message);
        });
    }
   
});