<?php

Class VisualComposerSettings {

	function __construct() {
		add_action( 'vc_before_init', array($this,'geeksAcademyIntegrationWithVisualComposter'));
		add_shortcode( 'codehighliter', array($this,'codehighliter_func' ));
		add_shortcode( 'codepreview', array($this,'codepreview_func' ));
		add_shortcode( 'coderepl', array($this,'coderepl_func' ));
		add_shortcode( 'replitclass', array($this,'replitclass_func' ));
		add_shortcode( 'regextester', array($this,'regextester_func' ));
	}

	function geeksAcademyIntegrationWithVisualComposter() {
	   
	   vc_map( array(
	      "name" => __( "Code Highliter", "code-highliter" ),
	      "base" => "codehighliter",
	      "category" => __( "Content", "code-highliter"),
	      "params" => array(
	         array(
	            "type" => "checkbox",
	            "heading" => __( "Show line numbers", "code-highliter" ),
	            "param_name" => "linenumbers",
	            "value" => array('on'   => 'true' ),
	            "description" => __( "Line numbers on the left of the container.", "code-highliter" )
	         ),
	         array(
	            "type" => "checkbox",
	            "heading" => __( "Is this new code example?", "code-highliter" ),
	            "param_name" => "newcodeexample",
	            "value" => array('on'   => 'true' ),
	            "description" => __( "True if you added the code before the base64 encodeing update.", "code-highliter" )
	         ),
	        array(
	            "type" => "dropdown",
	            "heading" => "Language",
	            "param_name" => "codelanguage",
	            "value" => array('html' => 'markup',
	                            'JS' => 'javascript',
	                            'CSS' => 'css',
	                            'Python' => 'python',
	                            'GIT' => 'git',
	                            'JSON' => 'json',
	                            'PHP' => 'php',
	                            'SQL' => 'sql',
	                            'YAML' => 'yaml'),
	            "description" => __( "Select the language for codeview", "code-highliter" )
	         ),
	        array(
	            "type" => "textarea_raw_html",
	            "holder" => "div",
	            "weight" => 20,
	            "heading" => __( "Content", "code-highliter" ),
	            "param_name" => "content",
	            "value" => __( "Write the code here", "code-highliter" ),
	            "description" => __( "Write you code lines.", "code-highliter" )
	            )
	        )
	   ) );


	   vc_map( array(
	      "name" => __( "Code Preview", "code-preview" ),
	      "base" => "codepreview",
	      "category" => __( "Content", "code-preview"),
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

	   vc_map( array(
	      "name" => __( "Code REPL", "code-repl" ),
	      "base" => "coderepl",
	      "as_parent" => array('only' => 'codepreview, codehighliter'),
	      "content_element" => true,
	      "show_settings_on_create" => true,
	      "is_containter" => true,
	      "params" => array(
	        array(
	            "type" => "dropdown",
	            "heading" => "Type",
	            "param_name" => "countainertype",
	            "value" => array('Tabs' => 'tabs',
	                            'Window' => 'window'),
	            "description" => __( "Select the language for codeview", "code-repl" )
	            )
	        ),
	      "js_view" => "VcColumnView"
	    ));

	   vc_map( array(
	      "name" => __( "Replit Classroom", "replit-class" ),
	      "base" => "replitclass",
	      "category" => __( "Content", "replit-class"),
	      "params" => array(
	        array(
	            "type" => "textfield",
	            "holder" => "div",
	            "heading" => __( "URL", "replit-class" ),
	            "param_name" => "classurl",
	            "value" => __( "Write the URL here", "replit-class" ),
	            "description" => __( "Replit URL to embed the class", "replit-class" )
	            )
	        )
	   ) );

	   vc_map( array(
	      "name" => __( "Regex Tester", "regex-texter" ),
	      "base" => "regextester",
	      "category" => __( "Content", "regex-texter"),
	      "params" => array(
	        array(
	            "type" => "textarea_raw_html",
	            "heading" => "Regular Expression",
	            "param_name" => "reg_expression",
	            "description" => __( "Type the regex to test", "regex-texter" )
	         ),
	        array(
	            "type" => "textarea",
	            "holder" => "div",
	            "heading" => __( "Content", "code-highliter" ),
	            "param_name" => "content",
	            "description" => __( "Type the content to test", "code-highliter" )
	            )
	        )
	   ) );
	}

	function codehighliter_func( $atts , $content = null) {
	   extract( shortcode_atts( array(
	      'linenumbers' => 'true',
	      'newcodeexample' => 'false',
	      'codelanguage' => 'markup'
	   ), $atts ) );

	   if(!$newcodeexample or $newcodeexample=='false') {
	   	$content = wpb_js_remove_wpautop($content, true);
	   }
	   else {
	    $content = urldecode(base64_decode($content));
	   	if($codelanguage=='html' || $codelanguage=='markup') $content = htmlentities($content);
	   }

	   if(!$linenumbers or $linenumbers!='true') $numerstring = '';
	   else $numerstring = 'line-numbers';
	  
	   return '<pre class="'.$numerstring.'"><code class="language-'.$codelanguage.'">'.$content.'</code></pre>';
	}

	function codepreview_func( $atts , $content = null) {
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

	function coderepl_func( $atts , $content = null) {

	    extract( shortcode_atts( array(
	      'countainertype' => 'tabs'
	   ), $atts ) );
	   $content = wpb_js_remove_wpautop($content, true);
	   return '<div class="code-'.$countainertype.'">'.$content.'</div>';
	}

	function replitclass_func( $atts) {
	   extract( shortcode_atts( array(
	      'classurl' => ''
	   ), $atts ) );

	   return '<iframe frameborder="0" width="100%" height="600px" src="'.$classurl.'"></iframe>';
	}

	function regextester_func( $atts , $content = null) {
	    extract( shortcode_atts( array(
	      'reg_expression' => '',
	      'height' => '200px'
	   ), $atts ) );

	   $reg_expression = rawurlencode($reg_expression);
	   $content = urlencode(base64_encode($content));
	   $srcURL = 'https://assets.breatheco.de/live-demos/js/regex-tester/?encoded=true&e='.$reg_expression.'&c='.$content;
	   $htmlcontent = '<iframe style="border:0; overflow:hidden;" frameborder="0" width="100%" height="'.$height.'" src="'.$srcURL.'"></iframe>';
	   return $htmlcontent;
	}

}

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_coderepl extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_codepreview extends WPBakeryShortCode {}
    class WPBakeryShortCode_codehighliter extends WPBakeryShortCode {}
}
