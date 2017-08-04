<?php
get_header('boxed'); 
$args = WPAS\Controller\WPASController::getViewData();
?>
    <div class="container main-content text-center profile-content">
        <div class='avatar' style="background-image: url('https://www.gravatar.com/avatar/<?php echo md5($args['user']['email']); ?>');">
            <a target="_blank" href="https://gravatar.com/site/signup/"><i class="fa fa-pencil"></i></a>
        </div>
        <h1><?php echo $args['user']['first_name']; ?> <?php echo $args['user']['last_name']; ?></h1>
        <h4 class='profile-type'>Type: <?php echo $args['user']['type']; ?> - Member since: <?php echo date("M Y", strtotime($args['user']['user_registered'])); ?></h4>
        <p class='profile-description'>
            <?php if($args['user']['description']){ ?>
                <?php echo $args['user']['description']; ?>
            <?php }else{ ?>
                You don't have a description yet, click here to set it.
            <?php } ?>
        </p>
        <div id="specialties">
            <ul class="specialty">
                <?php if(is_array($args['specialties'])) foreach($args['specialties'] as $specialty) { ?>
                <li>
                        <ul class="talent-badge">
                        <?php foreach($specialty->badges as $badgeSlug) { 
                            $fullBadge = $args['getBadge']($args['allBadges'], $badgeSlug);
                        ?>
                            <li data-slug="<?php echo $badgeSlug; ?>" class="single-badge <?php echo $badgeSlug; ?>">
                                <div class="avatar-container p-<?php echo $args['allStudentBadges'][$badgeSlug]['percent']; ?>">
                                    <div alt="" class="avatar"></div>
                                    <div class="info js-active"><div class="info-inner"><?php echo $args['allStudentBadges'][$badgeSlug]['percent']; ?>%</div></div>
                                </div>
                                <span class='badge-name'><?php echo $fullBadge->name; ?></span>
                            </li>
                        <?php } ?>
                        </ul>
                </li>
                <?php } ?>
            </ul>
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
        <a id="update-profile" data-toggle="modal" data-target="#modal-update_profile" href="#" data-mfb-label="Update profile info" class="mfb-component__button--child">
          <i class="mfb-component__child-icon fa fa-pencil"></i>
        </a>
      </li>
    </ul>
  </li>
</ul>
<?php include(locate_template(VIEWS_PATH.'_partials/modal-update_profile.php')); ?>
<?php get_footer(); ?>