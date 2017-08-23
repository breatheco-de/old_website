window.$ = window.jQuery = require('jquery');

require('bootstrap');

require('./vendor/mfb');
//Require the styles of the app
require('../scss/style.scss')
import {JSDialog} from 'myclabs.jquery.confirm';

jQuery(document).ready(function(){
    
    $('[data-toggle="tooltip"]').tooltip(); 
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $(".sidebar-boxed").toggleClass("toggled");
    });
    
    $('.affixed-topbar').affix({
        offset: {
            top: 300
          }
    });
    
    $(".confirm").confirm();
    
    if(typeof browserChecker!== 'undefined')
    {
       browserChecker.init({ 
       		browsers: ['chrome']
    	});
    }
    
    console.log(WPAS_APP.wpas_controller);
    
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