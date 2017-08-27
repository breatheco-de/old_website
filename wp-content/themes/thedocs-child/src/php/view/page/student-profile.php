<?php
get_header('boxed'); 
$args = WPAS\Controller\WPASController::getViewData();
if(is_a($args, 'WP_Error')) echo WPAS\Controller\WPASController::printError($args); 
?>
    <div class="container main-content text-center profile-content">
        <div class='row'>
            <div class='col-xs-12 col-sm-10 col-md-8 col-sm-offset-1 col-md-offset-2'>
                <div class='avatar' style="background-image: url('https://www.gravatar.com/avatar/<?php echo md5($args['user']['email']); ?>');">
                    <a target="_blank" href="https://gravatar.com/site/signup/"><i class="fa fa-pencil"></i></a>
                </div>
                <h1><?php echo $args['user']['first_name']; ?> <?php echo $args['user']['last_name']; ?></h1>
                <h5 class='profile-type'><?php echo ucfirst($args['user']['type']); ?> since: <?php echo date("M Y", strtotime($args['user']['user_registered'])); ?>
                <?php if(!empty($args['user']['github'])){ ?>
                    - <a target="_blank" href="http://www.github.com/<?php echo $args['user']['github']; ?>"><i class="fa fa-github" aria-hidden="true"></i> <?php echo $args['user']['github']; ?></a>
                <?php } ?>
                <?php if(!empty($args['user']['phone'])){ ?>
                    - <i class="fa fa-mobile" aria-hidden="true"></i> <?php echo $args['user']['phone']; ?>
                <?php } ?>
                </h5>
                <p class='profile-description'>
                    <?php if($args['user']['description']){ ?>
                        <?php echo $args['user']['description']; ?>
                    <?php }else{ ?>
                        The student does not have a description yet.
                    <?php } ?>
                </p>
            </div>
        </div>
        <div class='row student-profile-content'>
            <div class='col-sm-4'>
                <h4>Lastest Activity</h4>
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
            <div class='col-sm-4'>
                <h4>Assignments</h4>
            	<ul class='assignments'>
              <?php if(count($args['assignments'])==0) echo '<p>There are no assignments</p>'; ?>
          	  <?php foreach($args['assignments'] as $assignment){ ?>
                      <li class='row'>
                            <div class="col-xs-10">
                                <strong><?php echo $assignment->template->title; ?></strong> <br />
                                <i class="fa fa-calendar" aria-hidden="true"></i> 
                                <span class='duedate'><?php echo pll__( 'Due by' ); ?> <?php echo $assignment->duedate; ?></span>
                            </div>
                            <div class="col-xs-2">
                              <?php echo $args['getAssignmentStatus']($assignment->status); ?>
                            </div>
                      </li>
              <?php } ?>
            	</ul>
            </div>
            <div class='col-sm-4'>
                <div id="specialties">
                    <h4>Badges</h4>
                    <ul class="talent-badge">
                    <?php if(is_array($args['allBadges'])) foreach($args['allBadges'] as $fullBadge) {
                        $badgeSlug = $fullBadge->slug;
                    ?>
                        <li data-slug="<?php echo $badgeSlug; ?>" class="single-badge <?php echo $badgeSlug; ?>">
                            <div style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/badge-border/64/<?php echo $args['allStudentBadges'][$badgeSlug] ? $args['allStudentBadges'][$badgeSlug]['background-class'] : "0"; ?>.png')" class="badg-img-container p-<?php echo $args['allStudentBadges'][$badgeSlug] ? $args['allStudentBadges'][$badgeSlug]['background-class'] : "0"; ?>">
                                <img data-slug="<?php echo $badgeSlug; ?>" src="<?php echo BREATHECODE_API_HOST.$fullBadge->image_url; ?>" alt="" class="badg-img" />
                            </div>
                            <span class='badge-name'><?php echo htmlentities($fullBadge->name); ?> <?php echo $args['allStudentBadges'][$badgeSlug] ? $args['allStudentBadges'][$badgeSlug]['percent'] : "0"; ?>%</span>
                        </li>
                    <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<ul id="material-menu" class="mfb-component--br mfb-zoomin" data-mfb-toggle="hover">
  <li class="mfb-component__wrap">
    <a href="#" class="mfb-component__button--main">
      <i class="mfb-component__main-icon--resting fa fa-bars"></i>
      <i class="mfb-component__main-icon--active fa fa-times"></i>
    </a>
    <ul class="mfb-component__list">
      <li>
        <a id="enable-quiz" data-toggle="modal" data-target="#modal-enable_quiz" href="#" data-mfb-label="Re-enable Blocked Quiz" class="mfb-component__button--child">
          <i class="mfb-component__child-icon fa fa-question-circle"></i>
        </a>
      </li>
      <li>
        <a id="give-points" data-toggle="modal" data-target="#modal-give_badge_points" href="#" data-mfb-label="Give Points" class="mfb-component__button--child">
          <i class="mfb-component__child-icon fa fa-certificate"></i>
        </a>
      </li>
    </ul>
  </li>
</ul>
<?php include(locate_template(VIEWS_PATH.'_partials/modal-give_badge_points.php')); ?>
<?php include(locate_template(VIEWS_PATH.'_partials/modal-enable_quiz.php')); ?>
<?php get_footer(); ?>