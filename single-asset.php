<?php
/*
 * Template Name Posts: Assets Page
 * Description: A Page Template with a Page Builder design.
 */
get_header('asset'); 

?>
    <main class="container">
    <div class="row">
    <!-- Sidebar -->
        <aside class="col-md-3 col-sm-3 sidebar">

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
        <!-- Main content -->
        <article class="col-md-9 col-sm-9 main-content" role="main">
        
			<?php if (have_posts()){

					$postId = get_the_ID();
					$assetUrl = get_post_meta( $postId, 'wpcf-asset_url',true);
					$assetType = get_post_meta( $postId, 'wpcf-asset_type',true);
					$preview = get_post_meta( $postId, 'wpcf-asset_preview',true);

					if($preview and $preview!='')
						echo '<img class="asset-preview-img" src="'.$preview.'">';
					
					the_post();
					the_content();

					?>
			        <div class="callout callout-info" role="alert">
			            <h4>
			            	<i class="fa fa-download"></i>
			            	Download or view this asset
			            </h4>
			            <p>To download this asset right click and "save as..." the <a href="<?php echo $assetUrl; ?>">following link</a>.</p>
			        </div>

				<?php } else {
					echo 'Page Canvas For Page Builder'; 
				} ?>

        </article>

        <!-- END Main content -->
    </div>


</main>

<?php get_footer(); ?>