<?php
get_header('boxed'); 
$args = WPAS\Controller\WPASController::getViewData();
?>
    <main class='container quiz-content'>
        <div class="row intro">
            <div class="col-sm-6">
                <h1>Are you ready?</h1>
                <h4>There is still time to get scared!</h4>
            </div>
            <div class="col-sm-6">
                <h5>If you score 75% or more of the questions, you will get the following points:</h5>
                <ul class="talent-badge">
                <?php foreach($args['badges'] as $fullBadge) {
                    $badgeSlug = $fullBadge['slug'];
                ?>
                    <li data-slug="<?php echo $badgeSlug; ?>" class="single-badge <?php echo $badgeSlug; ?>">
                        <div class="badg-img-container" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/badge-border/64/9.png')">
                            <img data-slug="<?php echo $badgeSlug; ?>" src="<?php echo BREATHECODE_API_HOST.$fullBadge['image_url']; ?>" alt="" class="badg-img" />
                        </div>
                        <span class='badge-name'><?php echo htmlentities($fullBadge['name']); ?>: <strong><?php echo $fullBadge['points']; ?> pts</strong></span>
                    </li>
                <?php } ?>
            </ul>
            </div>
        </div>
        <?php if(isset($args['quiz']) && $args['blocked']==false){ ?>
            <input type="hidden" id="student" value="<?php echo $args['student_id']; ?>" />
            <input type="hidden" id="quiz" value="<?php echo $args['quiz']->info->slug; ?>" />
            <iframe class="bcquiz" src="<?php echo ASSETS_URL; ?>quiz/app/?slug=<?php echo $args['quiz']->info->slug; ?>" width="100%" height="600" frameBorder="0">Browser not compatible.</iframe>
        <?php } else if($args['blocked']==true){ ?>
            <div class="alert alert-danger">
              <strong>Oops!</strong> It seems you have already tried this quiz.
            </div>
        <?php } ?>
    </main>

<?php get_footer(); ?>