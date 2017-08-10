<?php
/*
 * Template Name: Single Page 1
 * Description: A Page Template with a Page Builder design.
 */
get_header('singlepage'); ?>

<?php  $description = get_post_meta(get_the_ID(),'_cmb_page_description', true); ?>
<main class="container">
      <div class="row">

        <!-- Sidebar -->
        <aside class="col-sm-3 sidebar">

                     <?php 
                      wp_nav_menu( 
                      array( 
                            'theme_location' => 'sidebar-page',
                            'container' => '',
                            'menu_class' => '', 
                            'menu_id' => '',
                            'menu'            => '',
                            'container_class' => '',
                            'container_id'    => '',
                            'echo'            => true,
                             'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                             'walker'            => new wp_bootstrap_navwalker(),
                            'before'          => '',
                            'after'           => '',
                            'link_before'     => '',
                            'link_after'      => '',
                            'items_wrap'      => '<ul class="nav sidenav dropable sticky  %2$s">%3$s</ul>',
                            'depth'           => 0,        
                        )
                     ); ?>

        </aside>
        <!-- END Sidebar -->


        <!-- Main content -->
        <article class="col-sm-9 main-content" role="main">
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
      </div>
    </main>
<?php get_footer(); ?>