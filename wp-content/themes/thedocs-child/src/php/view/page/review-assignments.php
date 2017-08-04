<?php

/*
 * Template Name: Teacher Dashboard
 */
get_header('boxed'); 
$args = WPAS\Controller\WPASController::getViewData();
?>
<main class="container">
	<h3>The following is a list of all your student's assignments</h3>
	<ul class='step-text assignments'>
		<?php if(count($args['assignments'])==0) echo '<p>There are no assignments</p>'; ?>
		<?php if(isset($args['assignments'])) foreach($args['assignments'] as $assignment){ ?>
                <li>
                  <div class="row push-right">
                    <div class="col-xs-9 col-md-10">
                      <h5><?php echo $assignment->template->title; ?></h5>
                      <p>
                        <i class="fa fa-user" aria-hidden="true"></i> <?php echo $assignment->student_name; ?>
                        <i class="fa fa-calendar" aria-hidden="true"></i> <?php echo pll__( 'Due by' ); ?> <?php echo $assignment->duedate; ?>
                      </p>
                    </div>
                    <div class="col-xs-3 col-md-2 assignment-bar">
                      <?php if($assignment->status=='delivered') { ?>
                        <a href="<?php echo $assignment->github_url; ?>" class="btn btn-xs btn-primary"><?php echo pll__( 'Review' ); ?></a>
                      <?php } else {?>
                        <?php echo $assignment->status; ?>
                      <?php } ?>
                    </div>
                  </div>
                </li>
        <?php } ?>
	</ul>
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

<?php get_footer(); ?>