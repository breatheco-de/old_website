<?php

namespace BreatheCode\WPTypes\PostType;
use BreatheCode\BCThemeOptions;
use BreatheCode\Utils\BreatheCodeAPI;
use WPAS\Messaging\WPASAdminNotifier as BCNotification;
use WPAS\Settings\WPASThemeSettingsBuilder;

class WPCohort{

	const META_MAIN_TEACHER = 'cohort-main-teacher';
	const META_COHORT_STAGE = 'cohort-stage';
	const META_BREATHECODE_ID = 'breathecode-id';
	const META_COHORT_SLACK = 'cohort-slack-url';
	const KICKOFF_DATE = 'cohort-kickoff-date';
	const META_COHORT_LOCATION = 'cohort-location';
	const POST_TYPE = 'user_cohort';

	public static $stages = array(
		"not-started" => "Not started yet",
		"on-prework" => "During Prework",
		"post-prework" => "Post Prework",
		"final-project" => "Doing Final Project",
		"finished" => "Finished"
	);

	private $excerciseClasses = array(
		"html" => '',
		"css" => '',
		"css-selectors" => '',
		"layouts" => '',
		"forms" => '',
		"arrays" => '',
		"events" => '',
		"scaffolding" => '',
		"bootstrap" => '',
		"the-dom" => '',
		"jquery-dom" => '',
		"from-js-to-php" => '',
		"object-oriented-programing" => '',
		"jquery-ajax" => ''
	);

	function __construct(){
		add_action( self::POST_TYPE.'_add_form_fields', array($this,'user_cohort_add_new_meta_field'), 10, 2 );
		add_action( self::POST_TYPE.'_edit_form_fields', array($this,'user_cohort_edit_meta_field'), 10, 2 );

		add_action( 'edited_'.self::POST_TYPE, array($this,'save_taxonomy_custom_meta'), 10, 2 );  
		add_action( 'create_'.self::POST_TYPE, array($this,'save_taxonomy_custom_meta'), 10, 2 );
		
		add_filter( 'bulk_actions-edit-'.self::POST_TYPE, array($this,'register_bulk_actions' ));
		add_filter( 'manage_edit-'.self::POST_TYPE.'_columns', array($this,'manage_columns' ),10,2);
		add_filter( 'manage_'.self::POST_TYPE.'_custom_column', array($this,'custom_columns' ),10,3);
		
		add_filter( 'handle_bulk_actions-edit-'.self::POST_TYPE, array($this, 'my_bulk_action_handler'), 10, 3 );
	}

	// Add term page
	function user_cohort_add_new_meta_field() {
		
		$teachers = $this->getTeachers();
		?>
		
		<div class="form-field">
			<label for="<?php echo self::KICKOFF_DATE; ?>"><?php _e( 'Kickoff Date', 'breathecode' ); ?></label>
			<input type="date" name="term_meta[<?php echo self::KICKOFF_DATE; ?>]">
			<p class="description"><?php _e( 'The exact date when the date starts','breathecode' ); ?></p>
		</div>
		
		<?php
		// the main teacher for the cohort
		?>
		<div class="form-field">
			<label for="<?php echo self::META_MAIN_TEACHER; ?>"><?php _e( 'Main Teacher', 'breathecode' ); ?></label>
			<select name="term_meta[<?php echo self::META_MAIN_TEACHER; ?>]">
				<option value="0">Select a teacher</option>
				<?php foreach ($teachers as $t) { ?>
					<option value="<?php echo $t->ID; ?>"><?php echo $t->display_name; ?></option>
				<?php } ?>
			</select>
			<p class="description"><?php _e( 'Who is going to be teaching the cohort','breathecode' ); ?></p>
		</div>

	<?php

		// the stage of the cohort
		?>
		<div class="form-field">
			<label for="<?php echo self::META_COHORT_STAGE; ?>"><?php _e( 'Cohort Status', 'breathecode' ); ?></label>
			<select name="term_meta[<?php echo self::META_COHORT_STAGE; ?>]">
				<?php foreach (self::$stages as $key => $val) { ?>
					<option value=term_meta["<?php echo $key; ?>]"><?php echo $val; ?></option>
				<?php } ?>
			</select>
			<p class="description"><?php _e( 'The current stage of the cohort','breathecode' ); ?></p>
		</div>
		<?php

		// the stage of the cohort
		?>
		<div class="form-field">
			<label for="<?php echo self::META_COHORT_SLACK; ?>"><?php _e( 'Slack Team URL', 'breathecode' ); ?></label>
			<input type="text" name="term_meta[<?php echo self::META_COHORT_SLACK; ?>]">
		</div>
		<?php
	}

	// Edit term page
	function user_cohort_edit_meta_field($term) {
	 
		$term_meta = get_option( "taxonomy_".$term->term_id );
		$teachers = $this->getTeachers();
	 
		// retrieve the existing value(s) for this meta field. This returns an array
		if(isset($term_meta[self::KICKOFF_DATE]))
		$kickoffDate = $term_meta[self::KICKOFF_DATE]; ?>
		<tr class="form-field">
		<th scope="row" valign="top"><label for="<?php echo self::KICKOFF_DATE; ?>"><?php _e( 'Kickoff Date', 'breathecode' ); ?></label></th>
			<td>
				<input type="date" name="term_meta[<?php echo self::KICKOFF_DATE; ?>]" value="<?php if(isset($kickoffDate)) echo $kickoffDate; ?>">
			</td>
		</tr>
		
	 	<?php
		// retrieve the existing value(s) for this meta field. This returns an array
		if(isset($term_meta[self::META_MAIN_TEACHER]))
		$mainTeacher = $term_meta[self::META_MAIN_TEACHER]; ?>
		
		<tr class="form-field">
		<th scope="row" valign="top"><label for="<?php echo self::META_MAIN_TEACHER; ?>"><?php _e( 'Main Teacher', 'breathecode' ); ?></label></th>
			<td>
				<select name="term_meta[<?php echo self::META_MAIN_TEACHER; ?>]">
					<option value="0">Select a teacher</option>
				<?php foreach ($teachers as $t) { ?>
					<option value="<?php echo $t->ID; ?>" <?php if(isset($mainTeacher) and $mainTeacher==$t->ID) echo 'selected'; ?>><?php echo $t->display_name; ?> (<?php echo $t->user_email; ?>)</option>
				<?php } ?>
				</select>
				<p class="description"><?php _e( 'Who is going to be teaching the cohort','breathecode' ); ?></p>
			</td>
		</tr>

		<?php 
		
		if(isset($term_meta[self::META_COHORT_STAGE ]))
		$cohortStage = $term_meta[self::META_COHORT_STAGE ]; ?>
		<tr class="form-field">
		<th scope="row" valign="top"><label for="<?php echo self::META_COHORT_STAGE; ?>"><?php _e( 'Cohort Stage', 'breathecode' ); ?></label></th>
			<td>
				<select name="term_meta[<?php echo self::META_COHORT_STAGE; ?>]">
				<?php foreach (self::$stages as $k => $v) { ?>
					<option value="<?php echo $k; ?>" <?php if(isset($cohortStage) and $cohortStage==$k) echo 'selected'; ?>><?php echo $v; ?></option>
				<?php } ?>
				</select>
				<p class="description"><?php _e( 'The current stage of the cohort','breathecode' ); ?></p>
			</td>
		</tr>
		<?php 
		if(isset($term_meta[self::META_COHORT_SLACK ]))
		$cohortSlack = $term_meta[self::META_COHORT_SLACK]; ?>
		<tr class="form-field">
		<th scope="row" valign="top"><label for="<?php echo self::META_COHORT_SLACK; ?>"><?php _e( 'Slack Group URL', 'breathecode' ); ?></label></th>
			<td>
				<input type="text" name="term_meta[<?php echo self::META_COHORT_SLACK; ?>]" value="<?php if(isset($cohortSlack)) echo $cohortSlack; ?>">
			</td>
		</tr>
		<?php 
		if(isset($term_meta[self::META_COHORT_LOCATION ]))
		$cohortLocation = $term_meta[self::META_COHORT_LOCATION]; 
		$locations = WPASThemeSettingsBuilder::getThemeOption('sync-bc-locations-api');
		?>
		<tr class="form-field">
		<th scope="row" valign="top"><label for="<?php echo self::META_COHORT_LOCATION; ?>"><?php _e( 'Location', 'breathecode' ); ?></label></th>
			<td>
				<select name="term_meta[<?php echo self::META_COHORT_LOCATION; ?>]">
					<option value="-1">Select a cohort location</option>
				<?php foreach ($locations as $l) { ?>
					<option value="<?php echo $l['slug']; ?>" <?php if(isset($cohortLocation) and $cohortLocation==$l['slug']) echo 'selected'; ?>><?php echo $l['name']; ?></option>
				<?php } ?>
				</select>
				<p class="description"><?php _e( 'The current Breathecode API location for the cohort','breathecode' ); ?></p>
			</td>
		</tr>
	<?php

		$this->printReplitExercises($term);

	}

	private function printReplitExercises($term){
		$term_meta = get_option( "taxonomy_".$term->term_id );
		
		$replitTemplateKeys = get_option( BCThemeOptions::THEME_OPTIONS_KEY.'replit-courses' );
		if(!$replitTemplateKeys or !is_array($replitTemplateKeys) or count($replitTemplateKeys)==0) 
			$replitTemplateKeys = $this->excerciseClasses;
		// put the term ID into a variable
		echo '<tr class="form-field"><td><h2>Repl.it Exercises</h2></td></tr>';
		foreach ($replitTemplateKeys as $key => $value) {
			$metaKey = "replit_".$key;
		?>
		<tr class="form-field">
		<th scope="row" valign="top"><label for="term_meta[replit_<?php echo $key; ?>]"><?php _e( $value.'('.$key.')', 'breathecode' ); ?></label></th>
			<td>
				<input type="text" name="term_meta[<?php echo $metaKey; ?>]" value="<?php echo ($term_meta[$metaKey]!='') ? $term_meta[$metaKey] : ''; ?>" />
				<p class="description"><?php _e( 'Replit class for the technology','breathecode' ); ?></p>
			</td>
		</tr>
		<?php
		}
	}

	// Save extra taxonomy fields callback function.
	function save_taxonomy_custom_meta( $term_id ) {
		
		if ( isset( $_POST['term_meta'] ) ) {
			$t_id = $term_id;
			$term_meta = get_option( "taxonomy_$t_id" );
			$cat_keys = array_keys( $_POST['term_meta'] );
			foreach ( $cat_keys as $key ) {
				if ( isset ( $_POST['term_meta'][$key] ) ) {
					$term_meta[$key] = $_POST['term_meta'][$key];
				}
			}
			// Save the option array.
			update_option( "taxonomy_$t_id", $term_meta );
		}
		if(isset( $_POST[self::META_COHORT_STAGE] ))
		{
			update_option( taxonomy_self::META_COHORT_STAGE, $_POST[self::META_COHORT_STAGE] );
		}
		if(isset( $_POST[self::META_MAIN_TEACHER] ))
		{
			update_option( self::META_MAIN_TEACHER, $_POST[self::META_MAIN_TEACHER] );
		}
		if(isset( $_POST[self::META_COHORT_SLACK] ))
		{
			update_option( self::META_COHORT_SLACK, $_POST[self::META_COHORT_SLACK] );
		}
	}  

	private function getTeachers(){
		$args = array(
			'role'         => 'main_teacher'
		);
		return get_users( $args );
	}
	
	/**
	 * Adds a new item into the Bulk Actions dropdown.
	 */
	function register_bulk_actions( $bulk_actions ) {
		$bulk_actions['move_cohort_to_next_phase'] = __( 'Move to next phase', 'breatehcode' );
		$bulk_actions['sync_with_api'] = __( 'Sync with API', 'breatehcode' );
		return $bulk_actions;
	}
	
	function manage_columns($columns){
		unset( $columns['description'] );
	    $columns['phase'] = 'Current Phase';
	    $columns['breathecode_id'] = 'API ID';
	    return $columns;
	}

	function custom_columns($c, $column_name, $term_id) {
		switch ( $column_name ) {
			case 'phase' :
				$termMeta = get_option( 'taxonomy_'.$term_id);
				if(isset($termMeta[WPCohort::META_COHORT_STAGE])) 
				{
					if(!isset(WPCohort::$stages[$termMeta[WPCohort::META_COHORT_STAGE]])) return 'No status';
					return WPCohort::$stages[$termMeta[WPCohort::META_COHORT_STAGE]];
				}
				return 'No status';
			break;
			case 'breathecode_id':
				$termMeta = get_option( 'taxonomy_'.$term_id);
				if(!empty($termMeta[WPCohort::META_BREATHECODE_ID])) echo $termMeta[WPCohort::META_BREATHECODE_ID];
				else echo 'Not synced';
			break;
		}
	}
	
	function my_bulk_action_handler( $redirect_to, $doaction, $term_ids ) {
	  if ( $doaction !== 'move_cohort_to_next_phase' && $doaction !== 'sync_with_api') {
	    return $redirect_to;
	  }
	  foreach($term_ids as $termId)
	  {
	  	if($doaction == 'move_cohort_to_next_phase') $this->moveCohortToNexPhase($termId);
	  	else if($doaction == 'sync_with_api') $this->sync_with_api($termId);
	  }
	  $redirect_to = add_query_arg( 'cohorts', count( $term_ids ), $redirect_to );
	  return $redirect_to;
	}
	
	function moveCohortToNexPhase($termId){
		$termMeta = get_option( 'taxonomy_'.$termId);
		
		if(!isset($termMeta)) return false;
		
		if(!isset($termMeta[WPCohort::META_COHORT_STAGE]))
		{
			$termMeta[WPCohort::META_COHORT_STAGE] = 'not-started';
			return update_option( "taxonomy_".$termId, $termMeta );
		}
		switch($termMeta[WPCohort::META_COHORT_STAGE])
		{
			case "not-started":
				$termMeta[WPCohort::META_COHORT_STAGE] = 'on-prework';
			break;
			case "on-prework":
				$termMeta[WPCohort::META_COHORT_STAGE] = 'post-prework';
			break;
			case "post-prework":
				$termMeta[WPCohort::META_COHORT_STAGE] = 'final-project';
			break;
			case "final-project":
				$termMeta[WPCohort::META_COHORT_STAGE] = 'finished';
			break;
		}
		
		return update_option( "taxonomy_".$termId, $termMeta );
	}
	
	function sync_with_api($termId){
	    $termMeta = get_option( 'taxonomy_'.$termId);
		$wpCohort = get_term($termId, self::POST_TYPE);
	    
		if($wpCohort)
		{
			if(!$wpCohort->parent) { 
				BCNotification::addTransientMessage(BCNotification::ERROR,'You cannot sync a parent cohort with the API, only its childs');
				return false;
			}
			if(empty($termMeta[self::META_COHORT_STAGE]) || $termMeta[self::META_COHORT_STAGE] == '-1')
			{
				BCNotification::addTransientMessage(BCNotification::ERROR,'The cohort '.$termId.' ('.$wpCohort->slug.') has an invalid stage');
				return false;
			}
	
			$locationId = $termMeta[self::META_COHORT_LOCATION];
			if(!$this->isValidLocationId($locationId)){
				BCNotification::addTransientMessage(BCNotification::ERROR,'The cohort '.$termId.' ('.$wpCohort->slug.') has an invalid location: '.$locationId);
				return false;
			} 
			
			if(!isset($termMeta[self::META_MAIN_TEACHER]) or $termMeta[self::META_MAIN_TEACHER]=='0'){
				BCNotification::addTransientMessage(BCNotification::ERROR,'The cohort '.$termId.' ('.$wpCohort->slug.') needs to have an instructor assigned');
				return false;
			}
			
			$termLanguage = pll_get_term_language( $termId);
			if(empty($termLanguage)){
				BCNotification::addTransientMessage(BCNotification::ERROR,'The cohort '.$termId.' ('.$wpCohort->slug.') needs to have main language');
				return false;
			}
			
			if(empty($termMeta[self::KICKOFF_DATE]) or $termMeta[self::KICKOFF_DATE]=='0'){
				BCNotification::addTransientMessage(BCNotification::ERROR,'The cohort '.$termId.' ('.$wpCohort->slug.') needs to have a kickoff date');
				return false;
			}
			
			$teacherId = get_user_meta( $termMeta[self::META_MAIN_TEACHER], 'breathecode_id', true);
			$slackUrl = $termMeta[self::META_COHORT_SLACK];
			
			$params = [
                  "slug" => $wpCohort->slug,
                  "name" => $wpCohort->name,
                  "instructor_id" => $teacherId,
                  "stage" => $termMeta[self::META_COHORT_STAGE],
                  "language" => $termLanguage,
                  "kickoff-date" => $termMeta[self::KICKOFF_DATE],
                  "location_slug" => $locationId
				];
				
			if(!empty($slackUrl)) $params['slack-url'] = $slackUrl;
			$cohort = BreatheCodeAPI::syncCohort($params);

			if(!$cohort) BCNotification::addTransientMessage(BCNotification::ERROR,'There was an issue syncronizing the cohort');
			else{
			    $termMeta[WPCohort::META_BREATHECODE_ID] = $cohort->id;
			    update_option( "taxonomy_".$termId, $termMeta );
			    BCNotification::addTransientMessage(BCNotification::SUCCESS,'The cohort '.$termId.' ('.$wpCohort->slug.') was synced successfully with breathecode ID: '.$cohort->id);
			}
		}
		else BCNotification::addTransientMessage(BCNotification::ERROR,'Cohort '.$termId.' not found');
	}
	
	private function isValidLocationId($locationId){
		$locations = WPASThemeSettingsBuilder::getThemeOption('sync-bc-locations-api');
		foreach($locations as $l) if($locationId == $l['slug']) return true;
		
		return false;
	}
}