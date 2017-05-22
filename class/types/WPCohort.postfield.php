<?php

namespace WPTypes;

class WPCohort{

	const META_MAIN_TEACHER = 'cohort-main-teacher';
	const META_COHORT_STAGE = 'cohort-stage';
	const META_COHORT_SLACK = 'cohort-slack-url';
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
		if(isset($term_meta[self::META_MAIN_TEACHER]))
		$mainTeacher = $term_meta[self::META_MAIN_TEACHER]; ?>
		<tr class="form-field">
		<th scope="row" valign="top"><label for="<?php echo self::META_MAIN_TEACHER; ?>"><?php _e( 'Main Teacher', 'breathecode' ); ?></label></th>
			<td>
				<select name="term_meta[<?php echo self::META_MAIN_TEACHER; ?>]">
					<option value="0">Select a teacher</option>
				<?php foreach ($teachers as $t) { ?>
					<option value="<?php echo $t->ID; ?>" <?php if(isset($mainTeacher) and $mainTeacher==$t->ID) echo 'selected'; ?>><?php echo $t->display_name; ?></option>
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

		$this->printReplitExercises($term);

	}

	private function printReplitExercises($term)
	{
		$term_meta = get_option( "taxonomy_".$term->term_id );
		// put the term ID into a variable
		echo '<tr class="form-field"><td><h2>Repl.it Exercises</h2></td></tr>';
		foreach ($this->excerciseClasses as $key => $value) {
			$metaKey = "replit_".$key;
		?>
		<tr class="form-field">
		<th scope="row" valign="top"><label for="term_meta[replit_<?php echo $key; ?>]"><?php _e( $key, 'breathecode' ); ?></label></th>
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

	private function getTeachers()
	{
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
		return $bulk_actions;
	}
	
	function manage_columns($columns){
		unset( $columns['description'] );
	    $columns['phase'] = 'Current Phase';
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
		}
	}
	
	function my_bulk_action_handler( $redirect_to, $doaction, $term_ids ) {
	  if ( $doaction !== 'move_cohort_to_next_phase' ) {
	    return $redirect_to;
	  }
	  foreach($term_ids as $termId)
	  {
	  	$this->moveCohortToNexPhase($termId);
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
}