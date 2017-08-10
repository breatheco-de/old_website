 <?php
/*
 * Template Name Posts: Asset Type
 * Description: A Page Template with a Page Builder design.
 */

get_template_part(VIEWS_PATH.'header/asset'); 
$args = WPAS\Controller\WPASController::getViewData();
?>
    <main class="container">
    <div class="row">
        <!-- Main content -->
        <article class="col-md-9 col-sm-9" role="main">
            <div class="row">
                <div class="col-md-12">
                    <h2><span class="label label-dark"><?php echo $args['term']->name; ?></span> <?php echo pll__( 'lesson assets' ); ?></h2>
					<ul class="list-view">
						<?php foreach ($args['posts_array'] as $asset) { 
							$postId = $asset->ID;
							$types = wp_get_post_terms($asset->ID,'asset-type');
							//if(empty($asset->post_excerpt)) $excerpt = wp_get_post_terms($asset->ID,'asset-type');
							$technologies = wp_get_post_terms($asset->ID,'asset-technology');
						?>
						  <li>
						    	<a class="btn btn-primary pull-right" href="<?php echo get_permalink($asset->ID); ?>"><?php echo pll__( 'View more' ); ?></a>
						    <h5><a href="<?php echo get_permalink($asset->ID); ?>"><?php echo $asset->post_title; ?></a></h5>
						    <p class="meta-data">
						    <?php echo $types[0]->name; ?> | 
						    <?php foreach ($technologies as $technology) { ?>
                                    <?php echo $technology->name; ?>, 
                            <?php } ?>
						 	</p>
						    <p>
                            <?php if ( empty( $asset->post_excerpt ) ) { ?>
                                <?php echo wp_kses_post( wp_trim_words( $asset->post_content, 40 ) ); ?>
                            <?php }else { ?>
                                <?php echo wp_kses_post( $asset->post_excerpt ); ?>
                            <?php } ?>
						    </p>
						  </li>
						<?php } wp_reset_postdata(); ?>
					</ul>
                </div>
            </div>
        </article>

        <!-- END Main content -->
        <!-- Sidebar -->
        <aside class="col-md-3 col-sm-3 sidebar">
            <h5><?php echo pll__( 'Browse other assets' ); ?>:</h5>
            <ul class="grid-view view-col-12">
              <li>
                <h6><?php echo pll__( 'By Technology' ); ?></h6>
                <?php $technologies = get_terms('asset-technology');
                foreach ($technologies as $technology) { ?>
                    <a href="<?php echo get_term_link($technology); ?>" class="label label-default"><?php echo $technology->name; ?></a>
                <?php } ?>
              </li>
              <li>
                <h6><?php echo pll__( 'By Type' ); ?></h6>
                <?php $types = get_terms('asset-type');
                foreach ($types as $t) { ?>
                    <a href="<?php echo get_term_link($t); ?>" class="label label-default"><?php echo $t->name; ?></a>
                <?php } ?>
              </li>
            </ul>
         <?php 
                      wp_nav_menu( 
                      array( 
                            'theme_location' => 'assets-menu',
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

<?php get_footer(); ?>