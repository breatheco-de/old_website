<?php

require('controllers.autoload.php');

class BCController{
    
    private $ajaxRouts = [];
    private $routes = [];
    protected static $args = [];
    
    public function __construct(){
        add_action('get_header', [$this,'load']);
        add_action( 'wp_enqueue_scripts', [$this,'loadScripts'] );
        add_action('get_footer', [$this,'loadFooter'],3,10);
    }
    
    public function route($view, $controller){
        $this->routes[$view] = $controller;
    }
    
    public function routeAjax($view, $controller, $method){
        if(!isset($this->ajaxRouts[$view])) $this->ajaxRouts[$view] = [];
        $this->ajaxRouts[$view][$controller] = $method;
    }
    
    public function loadAjax(){
        
        foreach($this->ajaxRouts as $view => $routes){
            foreach($routes as $controller => $method){
                $controller = 'BreatheCode\\Controller\\'.$controller;
                $v = new $controller();
                
                $methodName = 'ajax_'.$method;
                if(!is_callable([$v,$methodName])) throw new Exception('Ajax method '.$methodName.' does not exists in controller '.$controller);
                add_action('wp_ajax_nopriv_'.$method, [$v,$methodName]);
            }
        }
    }
    
    public function load(){
        foreach($this->routes as $view => $controller){
            
            if(is_page(strtolower($view)) || is_singular(strtolower($view))){
                $view = str_replace('-', '', $view);
                $controller = 'BreatheCode\\Controller\\'.$controller;
                $v = new $controller();
                if(is_callable([$v,'render'.$view])) self::$args = call_user_func([$v,'render'.$view]);
                else throw new Exception('Render method for view '.$view.' does not exists');
                return;
            } 
            
        }
    }
    
    public function loadScripts(){
        
        foreach($this->ajaxRouts as $view => $routes)
        {
    	    if(is_page(strtolower($view)) || is_singular(strtolower($view)))
    	    {
    		    wp_register_script( $view, get_stylesheet_directory_uri().'/assets/js/pages/'.strtolower($view).'.js' , array('ajaxmodule'), $this->prependversion, true );
    		    wp_enqueue_script( $view );
    	    }
        }
    }
    
    public function loadFooter(){
        foreach($this->ajaxRouts as $view => $routes)
        {
    	    if(is_page(strtolower($view)) || is_singular(strtolower($view)))
    	    {
    	        $this->loadJSController($view);
    	    }
        }
    }
    
    private function loadJSController($view){ 
        if(is_page(strtolower($view)) || is_singular(strtolower($view))){
            $view = str_replace('-', '', $view);
    ?>
        <script type="text/javascript">
        	window.onload = function(){
        		let v = new <?php echo $view ?>Controller({
        			"ajaxurl": '<?php echo admin_url( 'admin-ajax.php' ); ?>'
        		});
        		v.init();
        	}
        </script>
    <?php }
    }
    
    public static function getViewData(){
        return self::$args;
    }
    
    public static function ajaxSuccess($data){
		echo json_encode([ "code" => 200,"data" => $data ]);
		die(); 
    }
    
    public static function ajaxError($message){
		echo json_encode([ "code" => 500, "msg" => $message ]);
		die(); 
    }
    
}