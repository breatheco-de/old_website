<?php
get_header('boxed'); 
$args = WPAS\Controller\WPASController::getViewData();
?>
    <div class="container main-content specialties-content">
        <h1>The Talent Tree</h1>
        <h4>
            Your goal as a Geek is to earn as many badges as you can, <br /> we challenge you to obtain all and a special price will be awaiting!
        </h4>
        <div id="specialties">
            <ul class="specialty">
                <?php foreach($args['specialties'] as $specialty) { ?>
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
<?php get_footer(); ?>