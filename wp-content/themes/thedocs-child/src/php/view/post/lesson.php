<?php
/*
 * Template Name Posts: Lesson Box Sidebar
 * Description: A Page Template with a Page Builder design.
 */
get_template_part(VIEWS_PATH.'header/lessonsidebar');
$args = WPAS\Controller\WPASController::getViewData();
?>
    <main class="container-fluid">\
      <canvas id="demo-canvas"></canvas>
      <div id="large-header" class="lesson-introduction" style="margin-left: 0px; background-image: url('<?php echo $args['lesson']["background"];  ?>');">
        <div class="container">
          <div class="col-sm-6">
            <div class="row">
              <div class="col-xs-12">
                <h6>Reading time: <?php echo $args['lesson']["reading-time"];  ?></h6>
                <h1><?php echo $args['lesson']['title']; ?></h1>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <a class="start-lesson-icon btn btn-primary btn-lg" href="#">Read Lesson</a>
                
                <?php if(!empty($args['lesson']['replit'])){ ?>
                <a class="btn btn-warning btn-lg" href="<?php echo $args['lesson']['replit']; ?>">Access Replit's</a>
                <?php } ?>
                
                <?php if(!empty($args['lesson']['quiz'])){ ?>
                <a class="confirm btn btn-success btn-lg" href="<?php echo $args['lesson']['quiz']; ?>"
                data-text="<h5>Are you sure?</h5>You can take this quiz only once, maybe after you finish reading the lesson and have done all the replit's (if they exists)."
                data-confirm-button="Yes, I'm sure!"
                data-cancel-button="No, I better wait">Take Quiz</a>
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <p>&nbsp;</p>
            <h4><?php echo $args['lesson']['excerpt']; ?></h4>
          </div>
        </div>  
      </div>
      <div class="lesson-navegation">
        <ul class="nav nav-pills">
          <li><a class="start-lesson-icon" href="#"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i></a></li>
          <!--
              <li>
              <?php if($args['lesson']['previous-lesson']){ ?>
                <a class="btn btn-lg" href="<?php echo $args['lesson']['previous-lesson']; ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Prev Lesson</a>
              <?php } else { echo '&nbsp;'; } ?>
              </li>
              <li>
              <?php if($args['lesson']['next-lesson']){ ?>
                <a class="btn btn-lg" href="<?php echo $args['lesson']['next-lesson']; ?>">Next Lesson <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
              <?php } else { echo '&nbsp;'; } ?>
              </li>
          -->
        </ul>
      </div>
    <article class="main-content" role="main">
      <div class="row" style="margin-left: 0px;">
  
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
    </div>
  </article>


<?php get_footer('box-sidebar'); ?>