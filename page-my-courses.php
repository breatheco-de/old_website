<?php
/*
 * Template Name: Page My Courses
 * Description: A Page Template with a Page Builder design.
 */
get_header('boxed'); 

function get_courses()
{
	$terms = get_terms( array(
	    'taxonomy' => 'course'
	) );

	return $terms;
}


$courses = get_courses();
?>

<main class="container">
      <div class="row">

        <!-- Main content -->
        <article class="col-md-12 main-content" role="main">
          
          <?php if (have_posts()){ ?>
	
		<?php while (have_posts()) : the_post()?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	
	<?php }else {
		echo 'Page Canvas For Page Builder'; 
	}?>

          
        </article>
      </div>
		<div class="row">
			<?php foreach ($courses as $course) { ?>
              <div class="col-md-4 col-sm-6">
                <div class="promo small-icon left" style="height: 133px;">
                  <i class="fa fa-code"></i>
                  <h3><?php echo $course->name; ?></h3>
                  <p><?php echo $course->description; ?></p>
                  <a class="btn btn-primary btn-block" href="<?php echo esc_url( get_term_link( $course ) ); ?>">Get inside</a>
                </div>
              </div>
			<?php } ?>
        </div>
        <p>&nbsp;</p>
    </main>

<?php get_footer(); ?>