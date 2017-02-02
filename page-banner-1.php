<?php
/*
 * Template Name: Page Banner 1
 * Description: A Page Template with a Page Builder design.
 */
get_header('ban'); 

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
        <div class="col-md-12 main-content" role="main">
          
          <?php if (have_posts()){ ?>
		<?php while (have_posts()) : the_post()?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	
	<?php }else {
		echo 'Page Canvas For Page Builder'; 
	}?>

          
        </div>
      </div>
</main>

<?php get_footer(); ?>