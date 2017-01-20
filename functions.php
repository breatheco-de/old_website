<?php
/**
 * Setup thedocs Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function thedocs_child_theme_setup() {
	load_child_theme_textdomain( 'thedocs-child', get_stylesheet_directory() . '/languages' );

    register_nav_menus( array(
        'assets-menu' => 'Menu for browsing all the lesson assets'
    ) );

    //add formats suppor to the theme.
    add_theme_support( 'post-formats', array( 'link', 'video', 'image' ) );
    // add post-formats to post_type 'lesson-assets'
    add_post_type_support( 'lesson-asset', 'post-formats' ); 
}
add_action( 'after_setup_theme', 'thedocs_child_theme_setup' );

/*
 ESTILOS Y SCRIPTS
*/
function wmt_theme_style(){
 
        
}
//add_action( 'wp_enqueue_scripts', 'wmt_theme_style' );

/**
 * Hooks the WP cpt_post_types filter 
 *
 * @param array $post_types An array of post type names that the templates be used by
 * @return array The array of post type names that the templates be used by
 **/
function my_cpt_post_types( $post_types ) {
    $post_types[] = 'lesson';
    $post_types[] = 'lesson-asset';
    return $post_types;
}
add_filter( 'cpt_post_types', 'my_cpt_post_types' );


function ead_add_custompost_caps($data, $post_type) {
    if($post_type == 'lesson'){
        $args = array(
        'capability_type' => 'lesson',
        'capabilities' => array(
            'read_private_posts' => 'read_private_lessons',
            'read_post' => 'read_lesson',
            'delete_others_posts' => 'delete_other_lessons',
            'delete_posts' => 'delete_lessons',
            'delete_private_posts' => 'delete_private_lessons',
            'delete_published_posts' => 'delete_published_lessons',
            'edit_others_posts' => 'edit_other_lessons',
            'edit_posts' => 'edit_lessons',
            'edit_private_posts' => 'edit_private_lessons',
            'edit_published_posts' => 'edit_published_lessons',
            'manage_categories' => 'manage_lesson_categories',
            'manage_links' => 'manage_lesson_links',
            'publish_posts' => 'publish_lessons',
            'read' => 'read_lessons',
            'upload_files' => 'upload_lesson_files'
            )
        );
        $data = array_merge($data, $args);

    }
 
    return $data;
}
//add_filter( 'wpcf_type', 'ead_add_custompost_caps', 10, 2);


/*
*   FILTER POSTS BY TAXONOMY IN THE ADMIN
*
*/

function pippin_add_taxonomy_filters() {
    global $typenow;
 
    // an array of all the taxonomyies you want to display. Use the taxonomy name or slug
    $taxonomies = array('course');
 
    // must set this to the post type you want the filter(s) displayed on
    if( $typenow == 'lesson' ){
 
        foreach ($taxonomies as $tax_slug) {
            $tax_obj = get_taxonomy($tax_slug);
            $tax_name = $tax_obj->labels->name;
            $terms = get_terms($tax_slug);
            if(count($terms) > 0) {
                echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
                echo "<option value=''>Show All $tax_name</option>";
                foreach ($terms as $term) { 
                    echo '<option value='. $term->slug, (isset($_GET[$tax_slug]) and $_GET[$tax_slug] == $term->slug) ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
                }
                echo "</select>";
            }
        }
    }
}
add_action( 'restrict_manage_posts', 'pippin_add_taxonomy_filters' );

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
            "type" => "textarea_html",
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

    //Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_coderepl extends WPBakeryShortCodesContainer {
        }
    }
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_codepreview extends WPBakeryShortCode {}
        class WPBakeryShortCode_codehighliter extends WPBakeryShortCode {}
    }

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
}
add_action( 'vc_before_init', 'geeksAcademyIntegrationWithVisualComposter' );

function codehighliter_func( $atts , $content = null) {
   extract( shortcode_atts( array(
      'linenumbers' => 'true',
      'codelanguage' => 'markup'
   ), $atts ) );

   $content = wpb_js_remove_wpautop($content, true);

   if(!$linenumbers or $linenumbers!='true') $numerstring = '';
   else $numerstring = 'line-numbers';
  
   return '<pre class="'.$numerstring.'"><code class="language-'.$codelanguage.'">'.$content.'</code></pre>';
}
add_shortcode( 'codehighliter', 'codehighliter_func' );

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
add_shortcode( 'codepreview', 'codepreview_func' );

function coderepl_func( $atts , $content = null) {

    extract( shortcode_atts( array(
      'countainertype' => 'tabs'
   ), $atts ) );
   $content = wpb_js_remove_wpautop($content, true);
   return '<div class="code-'.$countainertype.'">'.$content.'</div>';
}
add_shortcode( 'coderepl', 'coderepl_func' );

function replitclass_func( $atts) {
   extract( shortcode_atts( array(
      'classurl' => ''
   ), $atts ) );

   return '<iframe frameborder="0" width="100%" height="600px" src="'.$classurl.'"></iframe>';
}
add_shortcode( 'replitclass', 'replitclass_func' );

include('class/GeeksAcademyOnline.class.php');