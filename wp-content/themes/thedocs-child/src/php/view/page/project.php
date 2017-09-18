<?php
get_header('boxed');
$args = WPAS\Controller\WPASController::getViewData();
?>

<?php if(is_a($args, 'WP_Error')){ ?>
    <div class="alert alert-danger fade in alert-dismissable text-center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
        <strong>Oooooppppsss!</strong> <?php echo implode(',',$args->get_error_messages()); ?>
    </div>
<?php } else { ?>
    <main class="container-fluid project-profile">
    <div class="row">
        <div class="col-xs-12 project-description">
            <h1><?php echo $args['project']['title']; ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="tabcontainer container">
                <input class='github-tabs' for="content1" id="tab1" type="radio" name="tabs" checked>
                <label for="tab1">Information</label>

                <input class='github-tabs' for="content2" id="tab2" type="radio" name="tabs">
                <label for="tab2">Readme</label>
                
                <?php if(!empty($args['project']['video-id'])){ ?>
                <input class='github-tabs' for="content3" id="tab3" type="radio" name="tabs">
                <label for="tab3">Video</label>
                <?php } ?>
                
                <input class='github-tabs' for="content4" id="tab4" type="radio" name="tabs">
                <label for="tab4">Badges</label>
                
            </div>
                
            <section id="content1">
                <div class="row container project-info">
                    <div class="col-xs-12">
                        <img class="img-responsive pull-left" alt="" src="http://placehold.it/300x300">
                        <ul class="list-group">
                            <li class="list-group-item"><?php echo $args['project']['description']; ?></li>
                            <li class="list-group-item">Duration: <?php echo $args['project']['duration']; ?> hrs</li>
                            <li class="list-group-item">Main technology: <?php echo $args['project']['technology']; ?></li>
                            <li class="list-group-item">Difficulty: <?php echo $args['project']['difficulty']; ?></li>
                            <li class="list-group-item">Category: <?php echo $args['project']['category']; ?></li>
                        </ul>
                    </div>
                </div>
            </section>
            <section id="content2">
                <div class="markdown-body container"><?php echo $args['readme']; ?></div>
            </section>
            
            <?php if(!empty($args['project']['video-id'])){ ?>
            <section id="content3">
                <iframe style="height: 90vh;" id="the-demo" width="100%" height="100%" frameborder="0" src="https://projects.breatheco.de/?vtutorial=../p/css/beginner/other/postcard/video.json"></iframe>
            </section>
            <?php } ?>
            
            <section id="content4">
                <h5>If you deliver your project you could be getting the following points:</h5>
                <ul class="talent-badge">
                    <?php if(count($args['badges'])==0){ ?> 
                        <li>Nothing, just the reward of knowing that you did it :)</li>
                    <?php } ?>
                <?php if(is_array($args['badges'])) foreach($args['badges'] as $fullBadge) {
                    $badgeSlug = $fullBadge['slug'];
                ?>
                    <li data-points="<?php echo $fullBadge['points']; ?>" data-slug="<?php echo $badgeSlug; ?>" class="single-badge <?php echo $badgeSlug; ?>">
                        <div class="badg-img-container" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/badge-border/64/9.png')">
                            <img data-slug="<?php echo $badgeSlug; ?>" src="<?php echo BREATHECODE_API_HOST.$fullBadge['image_url']; ?>" alt="" class="badg-img" />
                        </div>
                        <span class='badge-name'><?php echo htmlentities($fullBadge['name']); ?>: <strong><?php echo $fullBadge['points']; ?> pts</strong></span>
                    </li>
                <?php } ?>
                </ul>
            </section>
            
        </div>
    </div>
</main>
<?php } ?>
<?php get_footer(); ?>