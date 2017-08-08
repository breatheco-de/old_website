<?php
get_header('boxed'); 
$args = WPAS\Controller\WPASController::getViewData();
?>
    <div class="container main-content student-dashboard">
        <div class='row'>
            <div class='col-sm-5'>
                <h3 class='student-name'><?php echo $args['user']['first_name']; ?></h3>
                <?php echo $args['getBriefingMessage'](); ?>
            </div>
            <div class='col-sm-7'>
            </div>
        </div>
        <div class='row'>
            <div class='col-sm-5'>
                <h5 class='student-name'>Prepare yourself before each class...</h5>
            </div>
            <div class='col-sm-7'>
            </div>
        </div>
    </div>

<?php get_footer(); ?>