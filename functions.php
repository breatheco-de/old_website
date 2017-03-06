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
 
    wp_enqueue_style( 'style-skin', get_template_directory_uri().'/assets/css/skin-blue.css', array('theDocs.all.min.css'));
        
}
add_action( 'wp_enqueue_scripts', 'wmt_theme_style' );

/**
 * Hooks the WP cpt_post_types filter 
 *
 * @param array $post_types An array of post type names that the templates be used by
 * @return array The array of post type names that the templates be used by
 **/
function my_cpt_post_types( $post_types ) {
    $post_types[] = 'lesson';
    $post_types[] = 'lesson-asset';
    $post_types[] = 'lesson-project';
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


include('class/GeeksAcademyOptions.class.php');

include('class/GeeksAcademyOnline.class.php');
$GeeksAcademyOnline = new GeeksAcademyOnline();

include('class/VisualComposerSettings.class.php');
$VisualComposerSettings = new VisualComposerSettings();

include('class/GravityFormOptions.class.php');
$GravityFormOptions = new GravityFormOptions();

include('class/WPTypesOptions.class.php');
$TypesOptions = new WPTypesOptions();

