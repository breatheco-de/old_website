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
            'read_private_posts' => 'read_private_lesson',
            'read_post' => 'read_leasson',
            )
        );
        $data = array_merge($data, $args);

    }
 
    return $data;
}
add_filter( 'wpcf_type', 'ead_add_custompost_caps', 10, 2);


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

include('class/GeeksAcademyOnline.class.php');