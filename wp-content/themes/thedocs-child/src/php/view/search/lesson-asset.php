<?php
get_template_part(VIEWS_PATH.'header/asset'); 
$args = WPAS\Controller\WPASController::getViewData();
?>
    <div class='search-top-bar'>
        <div class="container search">
            <i class="fa fa-search" aria-hidden="true"></i>
            <input class='search-box' type="text" name="" placeholder="<?php echo pll__( 'Search Assets' ); ?>"/>
        </div>
        <div class="container">
            <span class='search-label'>Search on:</span>
            <div class="btn-group search-mode" data-toggle="buttons">
            <!--
              <label class="btn btn-primary">
                <input type="radio" name="options" value="lessons" autocomplete="off"> Lessons
              </label>
            -->
              <label class="btn btn-primary">
                <input type="radio" name="options" value="assets" autocomplete="off"> Assets
              </label>
            </div>
        </div>
    </div>
    <main class="container assets-list">
        <div class="row">
            <?php if(empty($args['posts_array'])){ ?>
                <div class="col-xs-12">We have nothing about that, try browsing by technology or by format.</div>
            <?php } ?>
            <!-- Main content -->
    		<?php if(!empty($args['posts_array'])) foreach ($args['posts_array'] as $asset) {
    			$postId = $asset->ID;
    			$types = wp_get_post_terms($postId,'asset-type');
    			if(!isset($types[0])) $types = '';
    			else $types = $types[0];
    			
    			$technologies = wp_get_post_terms($postId,'asset-technology');
    			$preview = get_post_meta( $postId, 'wpcf-asset_preview',true);
    		?>
            <article class="col-md-3" role="main">
                <div class="preview" style="background-image: url('<?php echo $preview; ?>');"></div>
    			<h5><a href="<?php echo get_permalink($asset->ID); ?>"><?php echo $asset->post_title; ?></a></h5>
    			<a class="btn btn-primary pull-right" href="<?php echo get_permalink($asset->ID); ?>"><?php echo pll__( 'View more' ); ?></a>
    		    <p class="meta-data">
    		    <?php echo $args['getIcon']($types); ?>
    		    <?php foreach ($technologies as $t) { ?>
                        <a href="<?php echo get_term_link($t); ?>" class="label label-default"><?php echo $t->name; ?></a>
                <?php } ?>
    		 	</p>
            </article>
    		<?php } wp_reset_postdata(); ?>
        </div>
    </main>

<?php get_footer(); ?>