<?php 

require_once get_template_directory() . '/visual/shortcodes.php';
require_once get_template_directory() . '/visual/vc_shortcode.php';
require_once get_template_directory() . '/framework/wp_bootstrap_navwalker.php';
require_once get_template_directory() . '/framework/widget/widget.php';
require_once get_template_directory() . '/framework/widget/recent-post.php';

//Define Text Doimain
$lang = get_template_directory_uri() . '/languages';
load_theme_textdomain('thedocs', $lang);


function thedocs_fonts_url() {
    $font_url = '';

    if ( 'off' !== _x( 'on', 'Google font: on or off', 'thedocs' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'Raleway:100,300,400,500%7CLato:300,400' ), "//fonts.googleapis.com/css" );
    }
    return $font_url;
}

function thedocs_theme_scripts_styles() {
	
	$protocol = is_ssl() ? 'https' : 'http';
    wp_enqueue_style( 'thedocs-fonts', thedocs_fonts_url(), array(), '1.0.0' );
    wp_enqueue_style( 'theDocs.all.min.css', get_template_directory_uri().'/assets/css/theDocs.all.min.css');
    wp_enqueue_style( 'custom.css', get_template_directory_uri().'/assets/css/custom.css');
    wp_enqueue_style( 'style-skin', get_template_directory_uri().'');

    wp_enqueue_style( 'style', get_stylesheet_uri(), array(), time() );


	wp_enqueue_script("theDocs.all.min.js", get_template_directory_uri()."/assets/js/theDocs.all.min.js",array(),false,true);
	wp_enqueue_script("custom.js", get_template_directory_uri()."/assets/js/custom.js",array(),false,true);

}
add_action( 'wp_enqueue_scripts', 'thedocs_theme_scripts_styles' );


function thedocs_theme_setup() {
    /*
     * This theme uses a custom image size for featured images, displayed on
     * "standard" posts and pages.
     */
	
	
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'menus' );
    add_theme_support( "title-tag" );
    add_theme_support( 'custom-header');
    add_theme_support( 'custom-background');
    add_theme_support( 'automatic-feed-links' );
if ( ! isset( $content_width ) ) $content_width = 900;
// This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => 'Primary Navigation Menu: Chosen menu in Home page, single, blog, pages ...',
        'footer-menu' => 'Footer Navigation Menu: Chosen menu ',
        'sidebar-menu' => 'Sidebar Navigation Menu: Chosen menu ',
        'sidebar-page' => 'Page Sidebar Navigation Menu: Chosen menu ',
    ) );
}
add_action( 'after_setup_theme', 'thedocs_theme_setup' );

if ( !function_exists('thedocs_pagination') ) {
	function thedocs_pagination() {
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return '';
		} ?>
			<?php if ( get_next_posts_link() ) : ?>
				<li class="previous"><?php next_posts_link( esc_html__('OLDER POSTS', 'thedocs') ); ?></li>
			<?php endif; ?>
			<?php if ( get_previous_posts_link() ) : ?>
				<li class="next"><?php previous_posts_link( esc_html__('NEWER POSTS', 'thedocs') ); ?></li>
			<?php endif; ?>
	<?php }
}



function thedocs_excerpt() {
  $redux_demo = get_option('redux_demo');
  if(isset($redux_demo['blog_excerpt'])){
    $limit = $redux_demo['blog_excerpt'];
  }else{
    $limit = 30;
  }
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

function thedocs_get_comment_author_link( $comment_ID = 0 ) {
    $comment = get_comment( $comment_ID );
    $url     = get_comment_author_url( $comment );
    $author  = get_comment_author( $comment );
 
    if ( empty( $url ) || 'http://' == $url )
        $return = '<b class="fn">Anonymous User</b>';
    else
        $return = "<a href='$url' rel='external nofollow' class='url'>$author</a>";
 
    
    return apply_filters( 'thedocs_get_comment_author_link', $return, $author, $comment->comment_ID );
}

function thedocs_theme_comment($comment, $args, $depth) {
    //echo 's';
   $GLOBALS['comment'] = $comment; ?>
<li class="comment">
  <div class="comment-body">
    <div class="comment-author">
    <div class="avatar"><?php echo get_avatar($comment,$size='70' ); ?></div>
    <cite class="fn"><a href="#"><?php printf( esc_html__('%s','thedocs'), thedocs_get_comment_author_link()) ?></a></cite><br>
    <p class="comment-date"><?php the_time('j F, Y'); ?></p>
    
    </div>
  <div class="comment-text">
    <p><?php comment_text() ?></p>
  </div>

  <div class="reply">
    <a class="comment-reply-link" href="#"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></a>
  </div>
 </div>
</li>
<?php       
}

// Widget Sidebar
    register_sidebar( array(
        'name'          => esc_html__( 'Primary Sidebar', 'thedocs' ),
        'id'            => 'sidebar-1',        
        'description'   => esc_html__( 'Appears in the sidebar blog section of the site.', 'thedocs' ),        
        'before_widget' => '<div id="%1$s" class="widget %2$s">',        
        'after_widget'  => '</div> ',        
        'before_title'  => '<h5 class="widget-title">',        
        'after_title'   => '</h5>'
    ) );



//Code Visual Compurso.
//if(class_exists('WPBakeryVisualComposerSetup')){
function thedocs_custom_css_classes_for_vc_row_and_vc_column($class_string, $tag) {
    if($tag=='vc_row' || $tag=='vc_row_inner') {
        $class_string = str_replace('vc_row-fluid', '', $class_string);
    }
    if($tag=='vc_column' || $tag=='vc_column_inner') {
    $class_string = preg_replace('/vc_col-sm-12/', 'col-md-12', $class_string);
    $class_string = preg_replace('/vc_col-sm-6/', 'col-md-6', $class_string);
    $class_string = preg_replace('/vc_col-sm-4/', 'col-md-4', $class_string);
    $class_string = preg_replace('/vc_col-sm-3/', 'col-md-3', $class_string);
    $class_string = preg_replace('/vc_col-sm-5/', 'col-md-5', $class_string);
    $class_string = preg_replace('/vc_col-sm-7/', 'col-md-7', $class_string);
    $class_string = preg_replace('/vc_col-sm-8/', 'col-md-8', $class_string);
    $class_string = preg_replace('/vc_col-sm-9/', 'col-md-9', $class_string);
    $class_string = preg_replace('/vc_col-sm-10/', 'col-md-10', $class_string);
    $class_string = preg_replace('/vc_col-sm-11/', 'col-md-11', $class_string);
    $class_string = preg_replace('/vc_col-sm-1/', 'col-md-1', $class_string);
    $class_string = preg_replace('/vc_col-sm-2/', 'col-md-2', $class_string);
    }
    return $class_string;
}
// Filter to Replace default css class for vc_row shortcode and vc_column
add_filter('vc_shortcodes_css_class', 'thedocs_custom_css_classes_for_vc_row_and_vc_column', 10, 2); 
// Add new Param in Row
if(function_exists('vc_add_param')){

vc_add_param('vc_row',array(
                              "type" => "textfield",
                              "heading" => esc_html__('Section Title', 'thedocs'),
                              "param_name" => "ses_title",
                              "value" => "",
                              "description" => esc_html__("Title of Section, Leave a blank do not show frontend.", "thedocs"),   
    )); 

vc_add_param('vc_row',array(
                             'type' => 'dropdown',
                             'heading' => esc_html__( 'Chosen type row', 'thedocs' ),
                             'param_name' => 'type_row',
                             'value' => array(
                                esc_html__( 'None Section', 'thedocs' ) => 'type2',
                                esc_html__( 'Sample', 'thedocs' ) => 'sample',
                                esc_html__( 'skin', 'thedocs' ) => 'skin',
                                esc_html__( 'transparent', 'thedocs' ) => 'transparent',
                                esc_html__( 'Pagetitle', 'thedocs' ) => 'pagetitle',
                                esc_html__( 'snippet', 'thedocs' ) => 'snippet',
                                esc_html__( 'carousel', 'thedocs' ) => 'carousel',
                             ),
                             'description' => esc_html__( 'Select type row', 'thedocs' )
      )); 

vc_add_param('vc_row',array(
                             'type' => 'attach_image',
                             'heading' => esc_html__( 'Image', 'thedocs' ),
                             'param_name' => 'ses_image',
                             'value' => '',
                             'description' => esc_html__( 'Select image from media library to do your signature.', 'thedocs' )
      )); 
vc_add_param('vc_row',array(
                              "type" => "textarea",
                              "heading" => esc_html__('Section ID', 'thedocs'),
                              "param_name" => "ses_id",
                              "value" => "",
                              "description" => esc_html__("Section ID, Leave a blank do not show frontend.", "thedocs"),   
    ));
vc_add_param('vc_row',array(
                              "type" => "textarea_html",
                              "heading" => esc_html__('Section Sub Title', 'thedocs'),
                              "param_name" => "ses_sub_title",
                              "value" => "",
                              "description" => esc_html__("Section Sub Title, Leave a blank do not show frontend.", "thedocs"),   
    ));




// Add new Param in Column  

vc_add_param('vc_column',array(
                             'type' => 'dropdown',
                             'heading' => esc_html__( 'Type', 'thedocs' ),
                             'param_name' => 'type',
                             'value' => array(
                                esc_html__( 'None', 'thedocs' ) => 'none',
                                esc_html__( 'Column', 'thedocs' ) => 'column',

                             ),
                             'description' => esc_html__( 'Select type section content', 'thedocs' )
      )); 
vc_add_param('vc_column',array(
                              "type" => "textfield",
                              "heading" => esc_html__('Column title', 'thedocs'),
                              "param_name" => "column_title",
                              "value" => "",
                              "description" => esc_html__("Column title", "thedocs"),   
    ));  
}




/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.4.0
 * @author     Thomas Griffin <thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo.com>
 * @copyright  Copyright (c) 2014, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/framework/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'thedocs_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
 
 
function thedocs_theme_register_required_plugins() {
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
             // This is an example of how to include a plugin from a private repo in your theme.
        array(
            'name'               => 'WPBakery Visual Composer', // The plugin name.
            'slug'               => 'js_composer', // The plugin slug (typically the folder name).
            'source'             => 'http://shtheme.com/plugins/thedocs/js_composer.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ),    
        // This is an example of how to include a plugin from the WordPress Plugin Repository.

       
        // This is an example of how to include a plugin from the WordPress Plugin Repository.
    array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => true,
        ),
        array(
            'name'                     => 'thedocs Common',
            'slug'                     => 'thedocs-common',
            'required'                 => true,
            'source'                   => 'http://shtheme.com/plugins/thedocs/thedocs-common.zip',
        )
    );
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => esc_html__( 'Install Required Plugins', 'thedocs' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'thedocs' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'thedocs' ), // %s = plugin name.
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'thedocs' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'thedocs' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'thedocs' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'thedocs' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'thedocs' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'thedocs' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'thedocs' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'thedocs' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'thedocs' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'thedocs' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'thedocs' ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'thedocs' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'thedocs' ),
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'thedocs' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
    tgmpa( $plugins, $config );
}
?>