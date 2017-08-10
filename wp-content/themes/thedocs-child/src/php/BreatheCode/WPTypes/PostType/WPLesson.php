<?php

namespace BreatheCode\WPTypes\PostType;

class WPLesson{
    const TAX_SLUG = 'lesson';
    private $user;

    function __construct()
    {
        add_action( 'restrict_manage_posts', [$this,'lesson_taxonomy_filters'] );
    }
    
    /*
    *   FILTER POSTS BY TAXONOMY IN THE ADMIN
    *
    */
    
    function lesson_taxonomy_filters() {
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
	
}