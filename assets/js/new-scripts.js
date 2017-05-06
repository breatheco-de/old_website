jQuery(document).ready(function(){

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

});   