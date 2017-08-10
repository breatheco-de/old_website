<?php
abstract class AbstractFunctionality
{
    // Force Extending class to define this method
    //abstract protected function getValue();
    //abstract protected function prefixValue($prefix);

	//magic function, called on creation,  
	//All of our hooks, filters and initializing code will go in here.
	public function __construct(){}
	
	//sets the directory (path) so that we can use this for our enqueuing
	// Defines our directory property which will let us easily enqueue files that we place in our CSS or JS directories.
	public function set_directory_value(){}

	//check if we need to flush rewrite rules. 
	//Handles the flushing of the pretty permalinks when we add our content type (which makes the new items work).
	public function check_flush_rewrite_rules(){}

	//enqueue public scripts and styles
	//Loads our public facing scripts and styles.
	public function enqueue_public_scripts_and_styles(){}
	
	//enqueue admin scripts and styles
	//Loads the admin scripts and styles.
	public function enqueue_admin_scripts_and_styles(){}

	//adding our new content type
	//Defines the new content type we are creating.
	public function add_content_type(){}

	//adding meta box to save additional meta data for the content type
	//Adds the meta boxes for our new content type.
	public function add_meta_boxes_for_content_type(){}

	//displays the visual output of the meta box in admin (where we will save our meta data)
	//Builds the back-end admin interface for the content type so we can save extra information.
	public function display_function_for_content_type_meta_box($post){}
	
	//Handles saving of the custom content type (and our meta information).
	//when saving the custom content type, save additional meta data
	public function save_custom_content_type($post_id){}

	//display additional meta information for the content type
	//@hooked using 'display_additional_meta_data' in theme
	//Displays the saved meta information on the front end.
	function display_additional_meta_data(){}

    // Common method
    public function printOut() {
        print $this->getValue() . "\n";
    }
}
