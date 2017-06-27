<?php
/*
 * Template Name Posts: Technology Asset
 * Description: A Page Template with a Page Builder design.
 */

get_header('asset'); 

$technology = get_queried_object();

$posts_array = get_posts(
    array(
        'posts_per_page' => -1,
        'post_type' => 'lesson-asset',
        'tax_query' => array(
            array(
                'taxonomy' => 'asset-technology',
                'field' => 'term_id',
                'terms' => $technology->term_id,
            )
        )
    )
);


//$posttitle = 'Cloud9 Keybindings File';
//$postid = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );
//echo $postid;

$post_id = 791;
$queried_post = get_post($post_id);
$title = $queried_post->post_title;
//echo $title."<br>";
//echo $queried_post->post_content."<br>";

//die(' =Cloud9 Keybindings File');

?>
    <main class="container">
    <div class="row">
        <!-- Main content -->
        <article class="col-md-9 col-sm-9" role="main">
            <div class="row">
                <div class="col-md-12">
                    <h2><?php echo pll__( 'Assets related to' ); ?> <span class="label label-dark"><?php echo $technology->name; ?></span></h2>
					<ul class="list-view">
						<?php foreach ($posts_array as $lesson) {
                            the_post(); 
							setup_postdata( $lesson );
							$postId = get_the_ID();
							$types = wp_get_post_terms($postId,'asset-type');
							$technologies = wp_get_post_terms($postId,'asset-technology');
						?>
						  <li>
						    	<a class="btn btn-primary pull-right" href="<?php the_permalink(); ?>"><?php echo pll__( 'View more' ); ?></a>
						    <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
						    <p class="meta-data">
						    <?php echo $types[0]->name; ?> | 
						    <?php foreach ($technologies as $technology) { ?>
                                    <?php echo $technology->name; ?>, 
                            <?php } ?>
						 	</p>
						    <p>
						    	<?php echo the_excerpt(); ?>
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
                foreach ($types as $type) { ?>
                    <a href="<?php echo get_term_link($type); ?>" class="label label-default"><?php echo $type->name; ?></a>
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