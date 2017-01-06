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