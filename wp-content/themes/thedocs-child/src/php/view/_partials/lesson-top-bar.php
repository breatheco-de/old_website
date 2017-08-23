<?php 
$args = WPAS\Controller\WPASController::getViewData();
?>
<header class="site-header navbar-fullwidth lesson-header">
      <!-- Top navbar & branding -->
      <nav id="main-nav-bar" class="navbar navbar-default">
        <div class="container">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="<?php echo get_permalink( get_page_by_path( 'my-courses' ) ); ?>">Back to courses</a></li>
          </ul>
        </div>
      </nav>
      <nav id="lesson-navbar" class="navbar navbar-default affixed-topbar">
        <div class="container">
          <!-- Toggle buttons and brand -->
          <!-- Top navbar -->
          <ul class="nav navbar-nav">
                <li>
                <?php if($args['lesson']['previous-lesson']){ ?>
                    <a href="<?php echo $args['lesson']['previous-lesson']; ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Previous</a>
                <?php } else { echo '&nbsp;'; } ?>
                </li>
                <li class="active"><a href="<?php echo get_category_link($args['course']->term_id); ?>"><?php echo $args['lesson']['title']; ?></a></li>
                <li>
                <?php if($args['lesson']['next-lesson']){ ?>
                    <a href="<?php echo $args['lesson']['next-lesson']; ?>">Next <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                <?php } else { echo '&nbsp;'; } ?>
                </li>
          </ul>
          <!-- END Top navbar -->

        </div>
      </nav>
      <!-- END Top navbar & branding -->
</header>