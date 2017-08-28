<?php

if ( !is_user_logged_in() ) {
   auth_redirect();
}

$userId = get_current_user_id();
$userType = get_user_meta($userId, 'type', true);
if($userType) wp_redirect(get_permalink( get_page_by_path( $userType ) ));

/*
 * Template Name: Page My Courses
 * Description: A Page Template with a Page Builder design.
 */
get_header('boxed'); 

$args = WPAS\Controller\WPASController::getViewData();
?>

<main class="container main-content">
    <?php if($content){ ?>
      <div class="row">
        <!-- Main content -->
        <article class="col-md-12 main-content" role="main">
            <?php echo $content; ?>          
        </article>
      </div>
    <?php } ?>
</main>

<?php get_footer(); ?>