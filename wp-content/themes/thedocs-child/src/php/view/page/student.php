<?php
get_header('boxed'); 
$args = WPAS\Controller\WPASController::getViewData();
?>
    <div class="container main-content student-dashboard">
        <div class='row'>
            <div class='col-sm-5'>
                <div class="well">
                    <h3 class='student-name'><?php echo $args['user']['display_name']; ?></h3>
                    <?php echo $args['getBriefingMessage'](); ?>
                </div>
                <div class="direct-access-links">
                    <ul>
                        <li><i class="fa fa-slack" aria-hidden="true"></i> Chat with your cohort</li>
                        <li><i class="fa fa-book" aria-hidden="true"></i> Access the courses</li>
                        <li><i class="fa fa-certificate" aria-hidden="true"></i> Earn some badges</li>
                    </ul>
                </div>
            </div>
            <div class='col-sm-7'>
            </div>
        </div>
    </div>

<?php get_footer(); ?>