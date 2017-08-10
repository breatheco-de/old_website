<?php
/*
 * Template Name: Single Page 3
 * Description: A Page Template with a Page Builder design.
 */
get_header('singlepage3'); ?>

<?php  $description = get_post_meta(get_the_ID(),'_cmb_page_description', true); ?>

    <main class="container-fluid">
    <!-- Main content -->
      <article class="main-content" role="main">
      <p class="lead"><?php echo esc_attr($description); ?></p>

<?php if (have_posts()){ ?>
	
		<?php while (have_posts()) : the_post()?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	
	<?php }else {
		echo 'Page Canvas For Page Builder'; 
	}?>
	 </article>
        <!-- END Main content -->
</main>

<?php get_footer('full'); ?>