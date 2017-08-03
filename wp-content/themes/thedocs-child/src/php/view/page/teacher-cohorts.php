<?php

use BreatheCode\WPTypes\PostType\WPCohort;
get_header('boxed'); 
$args = WPAS\Controller\WPASController::getViewData();
?>
    <div class="container main-content">
        <h1>Cohorts</h1>
        <table class="table table-hover table-no-lines">
            <?php if(count($args['cohorts'])==0) echo "<p>You don't belong to any cohorts</p>"; ?>
            <?php foreach($args['cohorts'] as $coh){ 
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