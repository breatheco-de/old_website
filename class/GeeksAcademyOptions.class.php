<?php

class GeeksAcademyOptions {

	var $settings_page_slug = "online-academy-settings";
	var $tabs = array( 'generalinfo' => '4G General', 'socialmedia' => 'Social Media' );

	function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );

		if(function_exists('pll_register_string'))
		{
			//pll_register_string( '', '' );

			pll_register_string( 'Phone Label', 'Phone' );
		}
	}

	function admin_menu() {
		add_theme_page(
			'Online Academy Theme - Settings',
			'OnlineAcademy Settings',
			'manage_options',
			$this->settings_page_slug,
			array($this,'theme_settings_page')
		);

		foreach ($this->tabs as $tab => $title) {
			add_submenu_page( null, 'Online Academy Theme - '.$title.' Settings', 'none', 'manage_options', $this->settings_page_slug.'-'.$tab, array($this,'theme_settings_page') );
		}

		add_action("admin_init", array( $this, 'register_theme_settings_page' ));
	}

	function display_textinput_element($args)
	{
		?>
	    	<input type="text" name="<?php echo $args["name"]; ?>" id="<?php echo $args["name"]; ?>" value="<?php echo get_option($args["name"]); ?>" />
	    <?php
	}

	function display_textarea_element($args)
	{
		?>
			<textarea style="width: 440px; height: 120px;" id="<?php echo $args["name"]; ?>" name="<?php echo $args["name"]; ?>"><?php echo get_option($args["name"]); ?></textarea>
	    <?php
	}

	function logo_display()
	{
		?>
	        <input type="file" name="logo" /> 
	        <?php echo get_option('logo'); ?>
	   <?php
	}

	function handle_logo_upload()
	{
		if(!empty($_FILES["demo-file"]["tmp_name"]))
		{
			$urls = wp_handle_upload($_FILES["logo"], array('test_form' => FALSE));
		    $temp = $urls["url"];
		    return $temp;   
		}
		  
		return $option;
	}

	function render_options($section_slug)
	{
	    ?>
		    <form method="post" action="options.php">
		        <?php
		            settings_fields($section_slug);
		            do_settings_sections($_GET['page']);      
		            submit_button(); 
		        ?>          
		    </form>
		<?php
	}

	function register_theme_settings_page()
	{
		$this->register_general_options();
		$this->register_socialmedia_options();
	}

	function register_socialmedia_options(){

		$section_slug = 'socialmedia';
		$current_page_section_slug = $this->settings_page_slug.'-'.$section_slug;

		add_settings_section($section_slug, "Social Media", null, $current_page_section_slug);
		add_settings_field("4gacademy_op-twitter_username", "Academy Twitter Account", array($this,'display_textinput_element'), $current_page_section_slug, $section_slug, array('name'=>'4gacademy_op-twitter_username'));
	    add_settings_field("4gacademy_op-facebook_username", "Academy Facebok Account", array($this,'display_textinput_element'), $current_page_section_slug, $section_slug, array('name'=>'4gacademy_op-facebook_username'));
	    add_settings_field("4gacademy_op-instagram_username", "Academy Instagram Account", array($this,'display_textinput_element'), $current_page_section_slug, $section_slug, array('name'=>'4gacademy_op-instagram_username'));
	    add_settings_field("4gacademy_op-googleplus_id", "Academy Googole+ Account", array($this,'display_textinput_element'), $current_page_section_slug, $section_slug, array('name'=>'4gacademy_op-googleplus_id'));
    	

	    register_setting($section_slug, "4gacademy_op-twitter_username");
	    register_setting($section_slug, "4gacademy_op-facebook_username");
	    register_setting($section_slug, "4gacademy_op-instagram_username");
	    register_setting($section_slug, "4gacademy_op-googleplus_id");
	}

	function register_general_options(){

		$section_slug = 'generalinfo';
		$current_page_section_slug = $this->settings_page_slug.'-'.$section_slug;

		add_settings_section($section_slug, "4Geeks General", null, $current_page_section_slug);
    	//add_settings_field("4gacademy_op-company_logo", "Logo", array($this,'logo_display'), $current_page_section_slug, $section_slug);  
    	add_settings_field("4gacademy_op-company_name", "Company Name", array($this,'display_textinput_element'), $current_page_section_slug, $section_slug, array('name'=>'4gacademy_op-company_name'));  
    	add_settings_field("4gacademy_op-company_logo", "Company Logo", array($this,'display_textinput_element'), $current_page_section_slug, $section_slug, array('name'=>'4gacademy_op-company_logo'));  
    	add_settings_field("4gacademy_op-company_favicon", "Company Favicon", array($this,'display_textinput_element'), $current_page_section_slug, $section_slug, array('name'=>'4gacademy_op-company_favicon'));  
    	add_settings_field("4gacademy_op-company_phone", "Phone", array($this,'display_textinput_element'), $current_page_section_slug, $section_slug, array('name'=>'4gacademy_op-company_phone'));  
    	add_settings_field("4gacademy_op-company_email", "Email", array($this,'display_textinput_element'), $current_page_section_slug, $section_slug, array('name'=>'4gacademy_op-company_email'));  
    	add_settings_field("4gacademy_op-company_address", "Address", array($this,'display_textarea_element'), $current_page_section_slug, $section_slug, array('name'=>'4gacademy_op-company_address'));  
    	add_settings_field("4gacademy_op-company_about_en", "About (English)", array($this,'display_textarea_element'), $current_page_section_slug, $section_slug, array('name'=>'4gacademy_op-company_about_en'));  
    	add_settings_field("4gacademy_op-company_about_es", "About (Spanish)", array($this,'display_textarea_element'), $current_page_section_slug, $section_slug, array('name'=>'4gacademy_op-company_about_es'));  
    	add_settings_field("4gacademy_op-company_latitude", "Latitude", array($this,'display_textinput_element'), $current_page_section_slug, $section_slug, array('name'=>'4gacademy_op-company_latitude'));  
    	add_settings_field("4gacademy_op-company_longitude", "Longitude", array($this,'display_textinput_element'), $current_page_section_slug, $section_slug, array('name'=>'4gacademy_op-company_longitude'));  

    	//register_setting($section_slug, "4gacademy_op-comapny_logo", "handle_logo_upload");
    	register_setting($section_slug, "4gacademy_op-company_about_en");
    	register_setting($section_slug, "4gacademy_op-company_about_es");
    	register_setting($section_slug, "4gacademy_op-company_name");
    	register_setting($section_slug, "4gacademy_op-company_logo");
    	register_setting($section_slug, "4gacademy_op-company_favicon");
    	register_setting($section_slug, "4gacademy_op-company_address");
    	register_setting($section_slug, "4gacademy_op-company_phone");
    	register_setting($section_slug, "4gacademy_op-company_email");
    	register_setting($section_slug, "4gacademy_op-company_latitude");
    	register_setting($section_slug, "4gacademy_op-company_longitude");
	}

	function theme_settings_page( $current = 'generalinfo' ) {
		global $pagenow;

		if (!current_user_can('manage_options')) {
		    wp_die('You do not have sufficient permissions to access this page.');
		}

		$links = array();
		foreach( $this->tabs as $tab => $name ) :
			if ( $tab == $current ) :
				$links[] = "<a class='nav-tab nav-tab-active' href='?page=".$this->settings_page_slug."-$tab'>$name</a>";
			else :
				$links[] = "<a class='nav-tab' href='?page=".$this->settings_page_slug."-$tab'>$name</a>";
			endif;
		endforeach;
		echo '<h2>';
		foreach ( $links as $link )
			echo $link;
		echo '</h2>';

		if ($pagenow == 'themes.php'){
			$breadcrumb = explode("-",$_GET["page"]);
			$this->render_options(array_pop($breadcrumb));
		}
	}
}

$GeeksAcademyOptions = new GeeksAcademyOptions();