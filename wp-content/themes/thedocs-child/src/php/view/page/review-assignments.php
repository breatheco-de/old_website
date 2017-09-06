<?php

/*
 * Template Name: Review Assignments
 */
get_header('boxed'); 
$args = WPAS\Controller\WPASController::getViewData();
?>
<main class="container review-assignments">
	<h3>The following is a list of all your student's assignments</h3>
	<?php if(isset($args['templates'])) foreach($args['templates'] as $template){ 
	      //if(count($template->assigntments)==0) continue;
	?>
      	<h4><?php echo $template['info']->title; ?></h4>
      	<div class='template'>
            	<ul class='assignments'>
              <?php if(count($template['assignments'])==0) echo '<p>There are no assignments</p>'; ?>
          	  <?php foreach($template['assignments'] as $assignment){ ?>
                      <li class='row'>
                            <div class="col-xs-8">
                                <strong><?php echo $assignment->student_name; ?></strong> <br />
                                <i class="fa fa-calendar" aria-hidden="true"></i> 
                                <?php echo pll__( 'Due by' ); ?> <?php echo $assignment->duedate; ?>
                            </div>
                            <div class="col-xs-4">
                            <?php if($assignment->status=='delivered') { ?>
                              <a target="_blank" href="<?php echo $assignment->github_url; ?>" class='btn btn-primary'><?php echo pll__( 'View' ); ?></a>
                              <button data-student='<?php echo $assignment->student_name; ?>' data-assignment='<?php echo $assignment->id; ?>' data-slug='<?php echo $assignment->template->project_slug; ?>' data-toggle="modal" data-target="#modal-accept_assignment" class='btn btn-success'><?php echo pll__( 'Accept' ); ?></button>
                            <?php } else {?>
                              <?php echo $assignment->status; ?>
                            <?php } ?>
                            </div>
                      </li>
              <?php } ?>
            	</ul>
	      </div>
    <?php } ?>
</main>
<ul id="material-menu" class="mfb-component--br mfb-zoomin" data-mfb-toggle="hover">
  <li class="mfb-component__wrap">
    <a href="#" class="mfb-component__button--main">
      <i class="mfb-component__main-icon--resting fa fa-bars"></i>
      <i class="mfb-component__main-icon--active fa fa-times"></i>
    </a>
    <ul class="mfb-component__list">
      <li>
        <a id="new-assignment" data-toggle="modal" data-target="#modal_new-assignment" href="#" data-mfb-label="Create new Assignment" class="mfb-component__button--child">
          <i class="mfb-component__child-icon fa fa-plus"></i>
        </a>
      </li>
    </ul>
  </li>
</ul>
<?php include(locate_template(VIEWS_PATH.'_partials/modal-new_assignment.php')); ?>
<?php include(locate_template(VIEWS_PATH.'_partials/modal-accept_assignment.php')); ?>

<?php get_footer(); ?>