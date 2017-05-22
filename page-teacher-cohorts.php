<?php

use WPTypes\WPCohort as WPCohort;

function getCohorsWithByTeacher($teacherId){
    $taxonomy = WPCohort::POST_TYPE;
    $args = array(	'taxonomy' => $taxonomy,
  //  				'meta_key' => WPCohort::META_MAIN_TEACHER,
//    				'meta_value' => $teacherId,
//    				'orderby' => 'meta_value',
 //   				'order' => 'DESC',
      				'hide_empty' => false,
      				'number' => 0
    			);
    $terms = get_terms($args); // Get all terms of a taxonomy
    return $terms;
}

$cohorts = getCohorsWithByTeacher(get_current_user_id());
get_header('boxed'); 
?>
    <div class="container">
        <h1>Cohorts</h1>
        <table class="table table-hover table-no-lines">
            <?php foreach($cohorts as $coh){ 
            if($coh->parent==0) continue;
            $term_meta = get_option('taxonomy_'.$coh->term_id);
            if($term_meta[WPCohort::META_MAIN_TEACHER]) $teacher = get_userdata($term_meta[WPCohort::META_MAIN_TEACHER]);
            ?>
            <tr>
                <td><?php echo $coh->term_id; ?></td>
                <td><?php echo $coh->name; ?></td>
                <td><?php echo $term_meta[WPCohort::META_COHORT_STAGE]; ?></td>
                <td><?php echo (isset($teacher)) ? $teacher->display_name : "No teacher assigned"; ?></td>
                <td><a class="btn btn-success" href="<?php echo get_term_link($coh->term_id); ?>">Details</a></td>
            </tr>
            <?php } ?>
        </table>
    </div>

<?php get_footer(); ?>