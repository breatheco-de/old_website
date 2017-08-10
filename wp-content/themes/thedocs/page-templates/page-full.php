<?php
/*
 * Template Name: Page Full No Banner
 * Description: A Page Template with a Page Builder design.
 */
get_header('full'); ?>
<?php  $sidebar = get_post_meta(get_the_ID(),'_cmb_sidebar_page', true); ?>
<?php if($sidebar == 'leftsidebar'){?>

<main class="container-fluid">
      <div class="row">

        <!-- Sidebar -->
        <aside class="col-lg-2 col-md-3 col-sm-3 sidebar">

            <?php 
                      wp_nav_menu( 
                      array( 
                            'theme_location' => 'sidebar-menu',
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
                            'items_wrap'      => '<ul class="sidenav dropable sticky  %2$s">%3$s</ul>',
                            'depth'           => 0,        
                        )
                     ); ?>

        </aside>
        <!-- END Sidebar -->


        <!-- Main content -->
        <article class="col-lg-10 col-md-9 col-sm-9 main-content" role="main">
          
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
<?php 
}elseif ($sidebar == 'rightsidebar') {?>



<main class="container-fluid">
      <div class="row">

        <!-- Main content -->
        <article class="col-md-9 col-sm-9 main-content" role="main">
          
          <?php if (have_posts()){ ?>
	
		<?php while (have_posts()) : the_post()?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	
	<?php }else {
		echo 'Page Canvas For Page Builder'; 
	}?>

          
        </article>
        <!-- END Main content -->

        <!-- Sidebar -->
        <aside class="col-md-3 col-sm-3 sidebar">

            <?php 
                      wp_nav_menu( 
                      array( 
                            'theme_location' => 'sidebar-menu',
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
                            'items_wrap'      => '<ul class="sidenav dropable sticky  %2$s">%3$s</ul>',
                            'depth'           => 0,        
                        )
                     ); ?>

        </aside>
        <!-- END Sidebar -->
      </div>
    </main>


<?php 
}else{?>
<main class="container-fluid">
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
    </main>
<?php }?>


<?php get_footer('full'); ?>