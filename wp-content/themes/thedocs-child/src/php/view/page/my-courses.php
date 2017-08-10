<?php

/*
 * Template Name: Page My Courses
 * Description: A Page Template with a Page Builder design.
 */
get_header('boxed'); 

$args = WPAS\Controller\WPASController::getViewData();
?>

<main class="container main-content">
    <?php if($content){ ?>
      <div class="row">

        <!-- Main content -->
        <article class="col-md-12 main-content" role="main">
            <?php echo $content; ?>          
        </article>
      </div>
    <?php } ?>
		<div class="row">
      <?php if(empty($args['courses']) or count($args['courses'])==0){?>
        <p><?php echo pll__("You don't seem to have access to any courses"); ?></p>
			<?php } else { ?>
  			<?php foreach ($args['courses'] as $course) { ?>
                <div class="col-md-4 col-sm-6">
                  <div class="promo small-icon left" style="height: 133px;">
                    <i class="fa fa-code"></i>
                    <h3><?php echo $course->name; ?></h3>
                    <p><?php echo $course->description; ?></p>
                    <a class="btn btn-primary btn-block" href="<?php echo esc_url( get_term_link( $course ) ); ?>"><?php echo pll__('Get inside'); ?></a>
                  </div>
                </div>
  			<?php } //foreach end ?>
			<?php } ?>
        </div>
        <p>&nbsp;</p>
    </main>

<?php get_footer(); ?>