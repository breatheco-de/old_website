<?php

/*
 * Template Name: Page My Courses
 * Description: A Page Template with a Page Builder design.
 */
get_header('boxed'); 

function get_courses()
{
	$terms = get_terms( array(
	    'taxonomy' => 'course',
      'meta_key' => 'wpcf-taxonomy-status',
      'meta_value' => 'publish'
	) );

	return $terms;
}


$courses = get_courses();
$content = false;
if(have_posts()) { 
  the_post();
  $content = do_shortcode(get_the_content());
}
?>

<main class="container">
    <?php if($content){ ?>
      <div class="row">

        <!-- Main content -->
        <article class="col-md-12 main-content" role="main">
            <?php echo $content; ?>          
        </article>
      </div>
    <?php } ?>
		<div class="row">
			<?php foreach ($courses as $course) { ?>
              <div class="col-md-4 col-sm-6">
                <div class="promo small-icon left" style="height: 133px;">
                  <i class="fa fa-code"></i>
                  <h3><?php echo $course->name; ?></h3>
                  <p><?php echo $course->description; ?></p>
                  <a class="btn btn-primary btn-block" href="<?php echo esc_url( get_term_link( $course ) ); ?>"><?php echo pll__('Get inside'); ?></a>
                </div>
              </div>
			<?php } ?>
        </div>
        <p>&nbsp;</p>
    </main>

<?php get_footer(); ?>