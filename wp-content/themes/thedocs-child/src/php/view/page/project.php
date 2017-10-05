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
        <div class="col-sm-4 col-md-3 project-navegation">
            <h3 class="project-title"><?php echo $args['project']['title']; ?></h3>
            <ul class="nav nav-pills nav-stacked">
              <li class="active"><a data-toggle="pill" href="#general"><label for="tab1">General</label></a></li>
                
              <li><a data-toggle="pill" href="#readme"><label for="tab2">Readme</label></a></li>
              <?php if(!empty($args['project']['video-id'])){ ?>
                  <li><a data-toggle="pill" href="#video"><label for="tab3">Video</label></a></li>
              <?php } ?>
              <li><a href="/projects">Back to projects</a></li>
            </ul>
        </div>
        <div class="col-sm-8 col-md-9 tab-content">
            <section id="general" class="tab-pane fade in active">
                <p class="project-description"><?php echo $args['project']['description']; ?></p>
                <div class="project-info">
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item">Duration: <?php echo $args['project']['duration']; ?> hrs</li>
                        <li class="list-group-item">Main technology: <?php echo $args['project']['technology']; ?></li>
                        <li class="list-group-item">Difficulty: <?php echo $args['project']['difficulty']; ?></li>
                        <li class="list-group-item">Category: <?php echo $args['project']['category']; ?></li>
                    </ul>
                </div>
                <div>
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
                </div>
                
            </section>
            <section id="readme" class="tab-pane fade in">
                <div class="markdown-body text-left"><?php echo $args['readme']; ?></div>
            </section>
            
            <?php if(!empty($args['project']['video-id'])){ ?>
            <section id="video" class="tab-pane fade in">
                <iframe style="height: 90vh;" id="the-demo" width="100%" height="100%" frameborder="0" src="https://projects.breatheco.de/?vtutorial=../p/css/beginner/other/postcard/video.json"></iframe>
            </section>
            <?php } ?>
            
            </div>
        </div>
    </div>
</main>
<?php } ?>
<?php get_footer(); ?>