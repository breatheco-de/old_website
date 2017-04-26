<?php

Class VisualComposerSettings {

	private $excerciseClasses = array(
		"html" => 'html',
		"css" => 'css',
		"layouts" => 'layouts',
		"arrays" => 'arrays',
		"events" => 'events',
		"scaffolding" => 'scaffolding',
		"bootstrap" => 'bootstrap',
		"the-dom" => 'the-dom',
		"jquery-dom" => 'jquery-dom',
		"from-js-to-php" => 'from-js-to-php',
		"object-oriented-programing" => 'object-oriented-programing',
		"jquery-ajax" => 'jquery-ajax'
	);

	function __construct() {
		add_action( 'vc_before_init', array($this,'geeksAcademyIntegrationWithVisualComposter'));
		add_shortcode( 'codehighliter', array($this,'codehighliter_func' ));
		add_shortcode( 'codepreview', array($this,'codepreview_func' ));
		add_shortcode( 'coderepl', array($this,'coderepl_func' ));
		add_shortcode( 'replitclass', array($this,'replitclass_func' ));
		add_shortcode( 'regextester', array($this,'regextester_func' ));
		add_shortcode( 'mysqltester', array($this,'mysqltester_func' ));
		add_shortcode( 'replitexercise', array($this,'replit_exercises_func' ));
	}

	function geeksAcademyIntegrationWithVisualComposter() {
	   
	   vc_map( array(
	      "name" => __( "Code Highliter", "code-highliter" ),
	      "base" => "codehighliter",
	      "category" => __( "BreatheCode", "code-highliter"),
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

	   vc_map( array(
	      "name" => __( "Code REPL", "code-repl" ),
	      "base" => "coderepl",
	      "as_parent" => array('only' => 'codepreview, codehighliter'),
	      "content_element" => true,
	      "category" => __( "BreatheCode", "breathecode"),
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
	      "category" => __( "BreatheCode", "breathecode"),
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
	      "category" => __( "BreatheCode", "regex-texter"),
	      "params" => array(
		        array(
		            "type" => "textfield",
		            "holder" => "div",
		            "heading" => __( "Box Height", "regex-texter" ),
		            "param_name" => "regexheight",
		            "value" => __( "200px", "regex-texter" ),
		            "description" => __( "The height of the test tool container.", "regex-texter" )
		        ),
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
		            "description" => __( "Type the content to test", "regex-highliter" )
		        )
	        )
	   ) );

	   vc_map( array(
	      "name" => __( "MySQL Tester", "mysql-texter" ),
	      "base" => "mysqltester",
	      "category" => __( "BreatheCode", "mysql-texter"),
	      "params" => array(
	      		array(
		            "type" => "textfield",
		            "holder" => "div",
		            "heading" => __( "Box Height", "mysql-texter" ),
		            "param_name" => "mysqlheight",
		            "value" => __( "200px", "mysql-texter" ),
		            "description" => __( "The height of the test tool container.", "mysql-texter" )
		        ),
		        array(
		            "type" => "textfield",
		            "holder" => "div",
		            "heading" => __( "Database sample", "mysql-texter" ),
		            "param_name" => "databasename",
		            "value" => __( "chat", "mysql-texter" ),
		            "description" => __( "Name of the database (used on the .sql and .png files)", "mysql-texter" )
		        ),
		        array(
		            "type" => "dropdown",
		            "heading" => "Table Styles",
		            "param_name" => "tablestyles",
		            "value" => array('hor-minimalist-a' => 'hor-minimalist-a',
		                            'hor-minimalist-b' => 'hor-minimalist-b',
		                            'ver-minimalist' => 'ver-minimalist',
		                            'box-table-a' => 'box-table-a',
		                            'box-table-b' => 'box-table-b',
		                            'hor-zebra' => 'hor-zebra',
		                            'ver-zebra' => 'ver-zebra',
		                            'newspaper-a' => 'newspaper-a',
		                            'newspaper-b' => 'newspaper-b'),
		            "description" => __( "Select the style of the tables", "mysql-highliter" )
		         )
	        )
	   ) );

	   
	   array_unshift($this->excerciseClasses,array("#"=>'Select an exercise topic'));
	   vc_map( array(
	      "name" => __( "Replit Exercise", "breathecode" ),
	      "base" => "replitexercise",
	      "category" => __( "BreatheCode", "breathecode"),
	      "params" => array(
		        array(
		            "type" => "textfield",
		            "holder" => "div",
		            "heading" => __( "Exercise Box Title", "breathecode" ),
		            "param_name" => "exercisetitle",
		            "description" => __( "What is going to appear on the exercise box", "breathecode" )
		        ),
		        array(
		            "type" => "dropdown",
		            "heading" => "Exercise Class Key",
		            "param_name" => "exercisestringkey",
		            "value" => $this->excerciseClasses,
		            "description" => __( "You have to pick one from the cohort exercises list", "breathecode" )
		         ),
	      		array(
		            "type" => "textarea_html",
		            "holder" => "div",
		            "heading" => __( "Description", "breathecode" ),
		            "param_name" => "content",
		            "description" => __( "Description for the objective of the exercises.", "breathecode" )
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
	      'regexheight' => '200px'
	   ), $atts ) );

	   $reg_expression = rawurlencode($reg_expression);
	   $content = urlencode(base64_encode($content));
	   $srcURL = 'https://assets.breatheco.de/live-demos/js/regex-tester/?encoded=true&e='.$reg_expression.'&c='.$content;
	   $htmlcontent = '<iframe style="border:0; overflow:hidden;" frameborder="0" width="100%" height="'.$regexheight.'" src="'.$srcURL.'"></iframe>';
	   return $htmlcontent;
	}

	function mysqltester_func( $atts , $content = null) {
	    extract( shortcode_atts( array(
	      'databasename' => '',
	      'mysqlheight' => '200px',
	      'tablestyles' => ''
	   ), $atts ) );

	   $srcURL = 'http://assets.breatheco.de/live-demos/sql/mysql-tester/?db='.$databasename.'&tablestyle='.$tablestyles;
	   $htmlcontent = '<iframe style="border:0; overflow:hidden;" frameborder="0" width="100%" height="'.$mysqlheight.'" src="'.$srcURL.'"></iframe>';
	   return $htmlcontent;
	}

	function replit_exercises_func( $atts , $content = null) {
	    extract( shortcode_atts( array(
	      'exercisestringkey' => '',
	      'exercisetitle' => ''
	   ), $atts ) );
	    $terms = wp_get_object_terms(get_current_user_id(),'user_cohort',array('orderby'=>'term_order'));
	    $term_id = 0;
	    $htmlcontent = '';
	    $linkURL = '';
	    if(count($terms)>0) 
	    {
	    	$term_id = $terms[0]->term_id;
	    	$term_name = $terms[0]->name;
	    	$term_meta = get_option( "taxonomy_".$term_id );
	    	if(isset($term_meta['replit_'.$exercisestringkey])) $linkURL = $term_meta['replit_'.$exercisestringkey];
		   $formatedContent = wpb_js_remove_wpautop($content, true);
		   $htmlcontent = '
				<section class="vc_cta3-container">
				<div class="vc_general vc_cta3 vc_cta3-style-classic vc_cta3-shape-rounded vc_cta3-align-center vc_cta3-color-pink vc_cta3-icons-on-border vc_cta3-icon-size-xl vc_cta3-icons-left vc_cta3-actions-bottom  wpb_animate_when_almost_visible wpb_appear wpb_start_animation">
					<div class="vc_cta3-icons">
						<div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-left">
							<div class="vc_icon_element-inner vc_icon_element-color-mulled_wine vc_icon_element-size-xl vc_icon_element-style- vc_icon_element-background-color-grey"><span class="vc_icon_element-icon fa fa-flask"></span>
							</div>
						</div>
					</div>
					<div class="vc_cta3_content-container">
						<div class="vc_cta3-content">
							<header class="vc_cta3-content-header">
								<h2>'.$exercisetitle.'</h2>									
							</header>
							<p style="text-align: center;">'.$formatedContent.'</p>
						</div>
						<div class="vc_cta3-actions">
							<div class="vc_btn3-container vc_btn3-center">
								<a class="vc_general vc_btn3 vc_btn3-size-lg vc_btn3-shape-rounded vc_btn3-style-modern vc_btn3-block vc_btn3-color-warning" href="'.$linkURL.'#term='.$term_name.'" title="" target="_blank" rel="nofollow">'.pll__('View more').'</a>
							</div>
						</div>
					</div>
				</div>
				</section>';

	    }
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
