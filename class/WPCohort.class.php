<?php

class WPCohort{

	const META_MAIN_TEACHER = 'cohort-main-teacher';
	const META_COHORT_STAGE = 'cohort-stage';
	const POST_TYPE = 'user_cohort';

	private $stage = array(
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
	}

	// Add term page
	function user_cohort_add_new_meta_field() {
		
		$teachers = $this->getTeachers();
		// the main teacher for the cohort
		?>
		<div class="form-field">
			<label for="<?php echo self::META_MAIN_TEACHER; ?>"><?php _e( 'Main Teacher', 'breathecode' ); ?></label>
			<select name="<?php echo self::META_MAIN_TEACHER; ?>">
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
			<select name="<?php echo self::META_COHORT_STAGE; ?>">
				<option value="0">Cohort Stage</option>
				<?php foreach ($this->stage as $key => $val) { ?>
					<option value="<?php echo $key; ?>"><?php echo $val; ?></option>
				<?php } ?>
			</select>
			<p class="description"><?php _e( 'The current stage of the cohort','breathecode' ); ?></p>
		</div>
		<?php
	}

	// Edit term page
	function user_cohort_edit_meta_field($term) {
	 
		$teachers = $this->getTeachers();
	 
		// retrieve the existing value(s) for this meta field. This returns an array
		$mainTeacher = get_option( self::META_MAIN_TEACHER ); ?>
		<tr class="form-field">
		<th scope="row" valign="top"><label for="<?php echo self::META_MAIN_TEACHER; ?>"><?php _e( 'Main Teacher', 'breathecode' ); ?></label></th>
			<td>
				<select name="<?php echo self::META_MAIN_TEACHER; ?>">
					<option value="0">Select a teacher</option>
				<?php foreach ($teachers as $t) { ?>
					<option value="<?php echo $t->ID; ?>" <?php if(isset($mainTeacher) and $mainTeacher==$t->ID) echo 'selected'; ?>><?php echo $t->display_name; ?></option>
				<?php } ?>
				</select>
				<p class="description"><?php _e( 'Who is going to be teaching the cohort','breathecode' ); ?></p>
			</td>
		</tr>
		<?php $cohortStage = get_option( self::META_COHORT_STAGE ); ?>
		<tr class="form-field">
		<th scope="row" valign="top"><label for="<?php echo self::META_COHORT_STAGE; ?>"><?php _e( 'Cohort Stage', 'breathecode' ); ?></label></th>
			<td>
				<select name="<?php echo self::META_COHORT_STAGE; ?>">
					<option value="0">Select a stage</option>
				<?php foreach ($this->stage as $k => $v) { ?>
					<option value="<?php echo $k; ?>" <?php if(isset($cohortStage) and $cohortStage==$k) echo 'selected'; ?>><?php echo $v; ?></option>
				<?php } ?>
				</select>
				<p class="description"><?php _e( 'The current stage of the cohort','breathecode' ); ?></p>
			</td>
		</tr>
	<?php

		$this->printReplitExercises($term);

	}

	private function printReplitExercises($term)
	{
		$term_meta = get_option( "taxonomy_".$term->term_id );
		// put the term ID into a variable
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
			update_option( self::META_COHORT_STAGE, $_POST[self::META_COHORT_STAGE] );
		}
		if(isset( $_POST[self::META_MAIN_TEACHER] ))
		{
			update_option( self::META_MAIN_TEACHER, $_POST[self::META_MAIN_TEACHER] );
		}
	}  

	private function getTeachers()
	{
		$args = array(
			'role'         => 'main_teacher'
		);
		return get_users( $args );
	}
}