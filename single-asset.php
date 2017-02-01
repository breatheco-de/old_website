<?php
/*
 * Template Name Posts: Assets Page
 * Description: A Page Template with a Page Builder design.
 */
get_header('asset'); 

if (have_posts()){
    the_post();

    $postId = get_the_ID();
    $assetUrl = get_post_meta( $postId, 'wpcf-asset_url',true);
    $assetType = get_post_meta( $postId, 'wpcf-asset_type',true);
    $preview = get_post_meta( $postId, 'wpcf-asset_preview',true);
?>
    <main class="container">
    <div class="row">
        <!-- Main content -->
        <article class="col-md-9 col-sm-9 main-content" role="main">
            <div class="row">
                <div class="col-md-12">
                    <h2><?php the_title(); ?></h2>
                </div>
            </div>
            <div class="row">
            <?php if($preview and $preview!='') { ?>
                <div class="col-sm-3">
                    <a class="btn btn-default" href="<?php echo $assetUrl ?>" data-lity>
                        <img class="img-responsive img-rounded" src="<?php echo $preview; ?>">
                    </a>
                </div>
                <div class="col-sm-9">
                    <?php echo the_content(); ?>
                </div>
            <?php } else { ?>
                <div class="col-sm-12">
                    <?php echo the_content(); ?>
                </div>
            <?php } ?>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped table-changelog">
                      <tbody>
                        <tr>
                            <td>Technologies:</td>
                            <td>
                                <?php $technologies = wp_get_post_terms($postId,'asset-technology');
                                foreach ($technologies as $technology) { ?>
                                    <a href="<?php echo get_term_link($technology); ?>" class="label label-default"><?php echo $technology->name; ?></a>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Asset Type</td>
                            <td>
                                <?php $types = wp_get_post_terms($postId,'asset-type');
                                foreach ($types as $type) { ?>
                                    <a href="<?php echo get_term_link($type); ?>" class="label label-default"><?php echo $type->name; ?></a>
                                <?php } ?>
                            </td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="callout callout-info" role="alert">
                        <h4>
                            <i class="fa fa-download"></i>
                            Download or view this asset
                        </h4>
                        <?php if($assetType=='image') { ?>
                            <p>Click here to download this asset: <a href="<?php echo $assetUrl; ?>" target="_blank" role="button" class="btn btn-lg btn-default"><i class="fa fa-download"></i> Download</a></p>
                        <?php } ?>
                        <?php if($assetType=='pdf') { ?>
                            <p>To download this asset right click and "save as..." the <a href="<?php echo $assetUrl; ?>">following link</a>.</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </article>

        <!-- END Main content -->
        <!-- Sidebar -->
        <aside class="col-md-3 col-sm-3 sidebar">
            <h5>Browse other assets:</h5>
            <ul class="grid-view view-col-12">
              <li>
                <h6>By Technology</h6>
                <?php $technologies = get_terms('asset-technology');
                foreach ($technologies as $technology) { ?>
                    <a href="<?php echo get_term_link($technology); ?>" class="label label-default"><?php echo $technology->name; ?></a>
                <?php } ?>
              </li>
              <li>
                <h6>By Type</h6>
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
<?php } ?>

<?php get_footer(); ?>