<?php
/**
 * The template for displaying 404 pages (Not Found)
 */
get_header('other'); ?>
    <main class="container">
    <div class="row">
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
        <!-- Main content -->
        <article class="col-md-9 col-sm-9 main-content" role="main">
        
      <section class="error-404 sec-padding">
                        <h2><span><?php echo esc_attr($redux_demo['404_title']);?></span> <?php echo esc_attr($redux_demo['404_desc']);?></h2>
                        <p><?php echo htmlspecialchars_decode($redux_demo['404_content']); ?></p>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-teal btn-lg btn-outline text-uppercase"><?php echo esc_attr($redux_demo['404_text1']);?> </a>
                    </section>



        </article>
        <!-- END Main content -->
    </div>


</main>

<?php get_footer(); ?>