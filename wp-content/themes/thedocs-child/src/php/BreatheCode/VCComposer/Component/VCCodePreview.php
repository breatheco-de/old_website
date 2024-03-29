<?php

namespace BreatheCode\VCComposer\Component;

class VCCodePreview{
    
    const BASE_NAME = 'codepreview';
    
    function __construct(){
        add_action( 'vc_before_init', array($this,'register'));
        add_shortcode( self::BASE_NAME, array($this,'render'));
    }
    
    function register()
    {
	   vc_map( array(
	      "name" => __( "Code Preview", "code-preview" ),
	      "base" => "codepreview",
	      "category" => __( "BreatheCode", "code-preview"),
	      "as_child" => array('only' => 'coderepl'),
	      "params" => array(
	         array(
	            "type" => "checkbox",
	            "heading" => __( "Bootstrap active", "code-preview" ),
	            "param_name" => "bootstrap",
	            "value" => array('on'   => 'true' ),
	            "description" => __( "Import bootstrap into the iframe.", "code-preview" )
	         ),
	        array(
	            "type" => "textarea_raw_html",
	            "holder" => "div",
	            "weight" => 20,
	            "heading" => __( "Content", "code-preview" ),
	            "param_name" => "content",
	            "value" => __( "Write the code here", "code-preview" ),
	            "description" => __( "Write you code lines, to add styles use  <style type=\"text/css\" scoped>", "code-preview" )
	            )
	        )
	   ) );
    }
    
	function render( $atts , $content = null) 
	{
	    extract( shortcode_atts( array(
	      'bootstrap' => 'false'
	   ), $atts ) );
	   $content = wpb_js_remove_wpautop(base64_decode($content), true);
	   $content = preg_replace( "/\r|\n/", "", $content );
	   
	   $contentBody = "<html><head>";
	   if($bootstrap and $bootstrap == 'true') $contentBody .= "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>";
	   $contentBody .= '</head><body>';
	   $contentBody .= $content;
	   $contentBody .= '</body></html>';
	   
	   $frameId = 'codePreviewFrame'.rand(0,9999999);
	   $htmlcontent = '<div class="code-preview"><iframe class="code-iframe" id="'.$frameId.'"  width="100%" frameBorder="0" src="about:blank"></iframe></div>
	                  <script type="text/javascript">
	                  var doc = document.getElementById(\''.$frameId.'\');
	                  doc.src = "data:text/html;charset=utf-8,'.$contentBody.'";
	                  </script>';
	   return $htmlcontent;
	}
}