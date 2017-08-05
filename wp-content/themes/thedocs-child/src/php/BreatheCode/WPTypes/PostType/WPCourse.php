<?php

namespace BreatheCode\WPTypes\PostType;

class WPCourse{
    const TAX_SLUG = 'course';
    private $user;

    function __construct()
    {
        // hook it up to 11 so that it overrides the original register_taxonomy function
        add_action( 'init', array($this,'wpse_modify_taxonomy'), 11 );
        add_filter( 'parent_file', array($this,'filter_user_taxonomy_admin_page_parent_file'));
		add_action( 'show_user_profile', array($this, 'show_user_course' ));
		add_action( 'edit_user_profile', array($this, 'show_user_course' ));
		add_action( 'personal_options_update', array($this, 'save_user_course' ));
		add_action( 'edit_user_profile_update', array($this, 'save_user_course' ));
    }
    
	function getUser(){
		if(!$this->user)
		{
			$this->user = wp_get_current_user();
		}

		return $this->user;
	}
    
    function wpse_modify_taxonomy() {
        // get the arguments of the already-registered taxonomy
        $taxonomyArgs = get_taxonomy( self::TAX_SLUG ); // returns an object
    
        // re-register the taxonomy
        register_taxonomy( self::TAX_SLUG,  array('user','lesson','lesson-asset','lesson-project','student-assignment'), (array) $taxonomyArgs );
    }
    
    /**
     * Fix position of user taxonomy in admin menu to be under Users by filtering parent_file
     * 
     * Should be used with 'parent_file' filter.
     * 
     * This is a fix to make edit-tags.php work as an editor of user taxonomies, it solves a 
     * problem where the "Posts" sidebar item is expanded rather than "Users". 
     * 
     * @see add_user_taxonomy_admin_page() which registers the user taxonomy page as edit-tags.php
     * @global string $pagenow Filename of current page (like edit-tags.php)
     * @param string $parent_file Filename of admin page being filtered
     * @return string Filtered filename
     */
    function filter_user_taxonomy_admin_page_parent_file( $parent_file = '' ) {
        global $pagenow;
    
        /**
         * Only filter the parent if we are on a the taxonomy screen for 
         */
        if ( ! empty( $_GET['taxonomy'] ) && ($_GET['taxonomy'] == self::TAX_SLUG) && $pagenow == 'edit-tags.php' ) {
            $parent_file = 'users.php';
        }
    
        return $parent_file;
    }
    
    /**
     * Function for updating a user taxonomy count.  
     * 
     * What this does is update the count of a specific term by the number of users that have been given the term. 
     *
     * See the _update_post_term_count() function in WordPress for more info.
     *
     * @see https://web.archive.org/web/20150327042855/http://justintadlock.com/archives/2011/10/20/custom-user-taxonomies-in-wordpress
     * @param array $terms List of Term taxonomy IDs
     * @param object $taxonomy Current taxonomy object of terms
     */
    function user_taxonomy_update_count_callback( $terms, $taxonomy ) {
        global $wpdb;
    
        foreach ( (array) $terms as $term ) {
            $count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wpdb->term_relationships WHERE term_taxonomy_id = %d", $term ) );
    
            do_action( 'edit_term_taxonomy', $term, $taxonomy );
            $wpdb->update( $wpdb->term_taxonomy, compact( 'count' ), array( 'term_taxonomy_id' => $term ) );
            do_action( 'edited_term_taxonomy', $term, $taxonomy );
        }
    } 
    

	function show_user_course( $user ) {
	 
	 	$currentUser = $this->getUser();
	 	if(in_array( 'administrator', $currentUser->roles ))
	 	{
		    //get the terms that the user is assigned to 
		    $assigned_terms = wp_get_object_terms( $user->ID, self::TAX_SLUG );
		    $assigned_term_ids = array();
		    foreach( $assigned_terms as $term ) {
		        $assigned_term_ids[] = $term->term_id;
		    }
		 
		    //get all the terms we have
		    $user_cats = get_terms( self::TAX_SLUG, array(
		        'hide_empty'=>false
		        ));
		 
		    echo "<h3>Courses</h3>";
		 
		     //list the terms as checkbox, make sure the assigned terms are checked
		    foreach( $user_cats as $cat ) { 
		    $status = get_term_meta($cat->term_id,'wpcf-taxonomy-status',true);
		    if(empty($status)) $status = 'not published';
		    if($status!='publish') $status = ' <span style="background: #ef7c7c; padding: 2px; color: white; font-size: 80%;">'.$status.'</span>';
		    else $status = '';
		    
		    if(!$cat->parent){
		    ?>
		        <input type="checkbox" id="<?php echo self::TAX_SLUG.'-'.$cat->term_id ?>" <?php if(in_array( $cat->term_id, $assigned_term_ids )) echo 'checked=checked';?> name="<?php echo self::TAX_SLUG; ?>[]"  value="<?php echo $cat->term_id;?>"/> 
		    <?php }
		    	echo '<label for="'.self::TAX_SLUG.'-'.$cat->term_id.'">'.$cat->name.$status.'</label>';
		    	echo '<br />';
		    }
	 	}
	}
	
	function save_user_course( $user_id ) {
	 
	 	//Only the admin
	 	$currentUser = $this->getUser();
	 	if(in_array( 'administrator', $currentUser->roles ))
	 	{
		 	if(!empty($_POST[self::TAX_SLUG]))
		 	{
				$user_terms = $_POST[self::TAX_SLUG];
				$terms = array_unique( array_map( 'intval', $user_terms ) );
				wp_set_object_terms( $user_id, $terms, self::TAX_SLUG, false );
			 
				//make sure you clear the term cache
				clean_object_term_cache($user_id, self::TAX_SLUG);
		 	}
	 	}
	}
	
}