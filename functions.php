<?php
/**
 * Setup thedocs Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function thedocs_child_theme_setup() {
	load_child_theme_textdomain( 'thedocs-child', get_stylesheet_directory() . '/languages' );
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
    return $post_types;
}
add_filter( 'cpt_post_types', 'my_cpt_post_types' );