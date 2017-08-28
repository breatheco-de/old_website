<?php
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