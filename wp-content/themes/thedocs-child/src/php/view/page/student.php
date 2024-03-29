<?php
get_header('boxed'); 
$args = WPAS\Controller\WPASController::getViewData();
?>
    <div class="container main-content student-dashboard">
        <div class='row'>
            <div class='col-xs-12'>
                <div class="well">
                    <h3 class='student-name'>Hello <?php echo $args['user']['display_name']; ?></h3>
                    <?php echo call_user_func($args['getBriefingMessage']); ?>
                </div>
            </div>
        </div>
        <div class='row'>
            <div class='col-sm-4'>
                <div class="direct-access-links">
                    <h5>What to do now?</h5>
                    <p>You main goal is to collect all the badges available, for that you will have to read the courses, complete your assignments and take some quizzes.</p>
                    <ul class="nav nav-pills nav-stacked">
                        <li role="presentation">
                            <a href="<?php echo get_permalink( get_page_by_path( 'my-courses' ) ); ?>"><i class="fa fa-book" aria-hidden="true"></i> Access the courses and start learning.</a>
                        </li>
                        <li role="presentation">
                            <a data-toggle="modal" data-target="#modal-talent_tree_explanation" href="#"><i class="fa fa-certificate" aria-hidden="true"></i> Earn badges to graduate.</a>
                        </li>
                        <li role="presentation">
                            <a href="<?php echo get_permalink( get_page_by_path( 'my-assignments' ) ); ?>"><i class="fa fa-check-circle" aria-hidden="true"></i> Complete your assignments</a>
                        </li>
                        <?php if(!empty($args['slack-url'])){ ?>
                        <li role="presentation">
                            <a target="_blank" href="<?php echo $args['slack-url']; ?>"><i class="fa fa-slack" aria-hidden="true"></i> Slack with your cohort fellows  (<?php echo $args['cohort']->name; ?>)</a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class='col-sm-8'>
                <div>
                    <h5>Your latest activity at the academy...</h5>
                    <ol class="activity-feed">
                        <?php foreach($args['activity'] as $act){ ?>
                            <li class="feed-item">
                                <time class="date" datetime="<?php echo date('m-d',strtotime($act->created_at)); ?>"><?php echo date('M d, Y',strtotime($act->created_at)); ?></time>
                                <span class="text"><?php echo $act->name; ?></span>
                            </li>
                        <?php } ?>
                    <?php if(count($args['activity'])==10){ ?>
                        <li class="feed-item">
                            <time class="date" style="text-transform: lowercase;" datetime="">... only last 10 activities are shown ...</time>
                        </li>
                    <?php } ?>
                            <li class="feed-item">
                                <time class="date" datetime="<?php echo date('m-d',strtotime($args['user']['user_registered'])); ?>"><?php echo date('M d, Y',strtotime($args['user']['user_registered'])); ?></time>
                                <span class="text">You started your journey at 4Geeks Academy!</span>
                            </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
<?php include(locate_template(VIEWS_PATH.'_partials/modal-talent_tree_explanation.php')); ?>
<?php get_footer(); ?>