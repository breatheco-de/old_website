<?php
get_header('boxed'); 
$args = BCController::getViewData();
?>
    <div class="container">
        <h1>The Talent Tree</h1>
        <h4>
            Your goal as a Geek is to earn as many badges as you can, we challenge you to obtain all and a special price will be awaiting!
        </h4>
        <div id="specialties">
            <ul class="specialty">
                <?php foreach($args['specialties'] as $specialty) { ?>
                <li>
                    <h3>As a <?php echo $specialty->name; ?>...</h3>
                        <ul class="talent-badge">
                        <?php foreach($specialty->badges as $badgeSlug) { 
                            $fullBadge = $args['getBadge']($args['allBadges'], $badgeSlug);
                        ?>
                            <li data-slug="<?php echo $badgeSlug; ?>" class="<?php echo $badgeSlug; ?>">
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