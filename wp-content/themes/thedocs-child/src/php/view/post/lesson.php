<?php
/*
 * Template Name Posts: Lesson Box Sidebar
 * Description: A Page Template with a Page Builder design.
 */
get_template_part(VIEWS_PATH.'header/lessonsidebar');
$args = WPAS\Controller\WPASController::getViewData();
?>
    <main class="container-fluid">
    <div class="row" style="margin-left: 0px;">
    <article class="main-content" role="main">

<?php if (have_posts()){ 
          the_post();
          $postId = get_the_ID();
          $assets = $args['getLessonAssets']($postId);
          the_content();

          if(count($assets)>0){
        ?>

          <section id="lesson-assets">
            <h2 id="assets"><a href="#assets"><?php echo pll__( 'Assets for this lessons' ); ?></a></h2>
            <p><?php echo pll__( 'We know is hard and some times overwhelming, we have prepared the following materials to help you.' ); ?></p>
            <ul class="step-text">
          <?php foreach ($assets as $asset){ ?>
              <li>
                <img class="asset-preview-img" src="<?php echo $asset["preview"]; ?>">
                <h5><?php echo $asset["title"]; ?></h5>
                <p><?php echo $asset["description"]; ?></p>
                <p><a class="btn btn-teal" href="<?php echo $asset["url"]; ?>"><?php echo pll__( 'Download' ); ?></a></p>
              </li>
          <?php } ?>
            </ul>
          </section>

        <?php } ?>

  <?php }else {
    echo 'Page Canvas For Page Builder'; 
  }?>
  </article>


<?php get_footer('box-sidebar'); ?>