<?php
get_template_part(VIEWS_PATH.'header/asset'); 
$args = WPAS\Controller\WPASController::getViewData();
?>
    <main class="container">
    <div class="row">
        <!-- Main content -->
        <article class="col-md-9 col-sm-9 main-content" role="main">
            <div class="row">
                <div class="col-md-12">
                    <h2><?php echo $args['post']->post_title; ?></h2>
                </div>
            </div>
            <div class="row">
            <?php if($args['preview'] and $args['preview']!='') { ?>
                <div class="col-sm-3">
                    <a class="btn btn-default" href="<?php echo $args['assetUrl'] ?>" data-lity>
                        <img class="img-responsive img-rounded" src="<?php echo $args['preview']; ?>">
                    </a>
                </div>
                <div class="col-sm-9">
                    <?php echo do_shortcode($args['post']->post_content); ?>
                </div>
            <?php } else { ?>
                <div class="col-sm-12">
                    <?php echo do_shortcode($args['post']->post_content); ?>
                </div>
            <?php } ?>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped table-changelog">
                      <tbody>
                        <tr>
                            <td><?php echo pll__( 'Technologies' ); ?>:</td>
                            <td>
                                <?php foreach ($args['technologies'] as $technology) { ?>
                                    <a href="<?php echo get_term_link($technology); ?>" class="label label-default"><?php echo $technology->name; ?></a>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo pll__( 'Asset Type' ); ?>:</td>
                            <td>
                                <?php foreach ($args['types'] as $type) { ?>
                                    <a href="<?php echo get_term_link($type); ?>" class="label label-default"><?php echo $type->name; ?></a>
                                <?php } ?>
                            </td>
                        </tr>
                      </tbody>
                    </table> 
                    <?php if(in_array($args['assetType'],['image','pdf','url'])) { ?>
                    <div class="callout callout-info" role="alert">
                        <?php if($args['assetType']=='image') { ?>
                            <p><?php echo pll__( 'Click here to download this asset' ); ?>: <a href="<?php echo $args['assetUrl']; ?>" target="_blank" role="button" class="btn btn-lg btn-default"><i class="fa fa-download"></i> <?php echo pll__( 'Download' ); ?></a></p>
                        <?php } ?>
                        <?php if($args['assetType']=='pdf' || $args['assetType']=='zip') { ?>
                            <p><a href="<?php echo $args['assetUrl']; ?>"><?php echo pll__( 'To download this asset right click and "save as..." the this text.' ); ?></a></p>
                        <?php } ?>
                        <?php if($args['assetType']=='url') { ?>
                            <p><a target="_blank" role="button" class="btn btn-lg btn-default" href="<?php echo $args['assetUrl']; ?>"><?php echo pll__( 'Go to website' ); ?></a></p>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </article>

        <!-- END Main content -->
        <!-- Sidebar -->
        <aside class="col-md-3 col-sm-3 sidebar">
            <h5><?php echo pll__('Browse other assets'); ?>:</h5>
            <ul class="grid-view view-col-12">
              <li>
                <h6><?php echo pll__('By Technology'); ?></h6>
                <?php $args['technologies'] = get_terms('asset-technology');
                foreach ($args['technologies'] as $technology) { ?>
                    <a href="<?php echo get_term_link($technology); ?>" class="label label-default"><?php echo $technology->name; ?></a>
                <?php } ?>
              </li>
              <li>
                <h6><?php echo pll__('By Type'); ?></h6>
                <?php $args['types'] = get_terms('asset-type');
                foreach ($args['types'] as $type) { ?>
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