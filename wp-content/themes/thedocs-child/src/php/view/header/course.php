<?php do_action( 'get_header'); ?>
<!DOCTYPE html>
<?php 
$args = WPAS\Controller\WPASController::getViewData();
?>
<html lang="en">
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <!-- Styles -->
    <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
        ?>
    <!-- Favicons-->
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri();?>/assets/img/logo.png" type="image/x-icon"/>
    <?php }?>
      <?php wp_head();?>
      <!-- Favicons -->
    
    </head>

  <body>

<header class="site-header navbar-transparent">

      <!-- Top navbar & branding -->
      <nav id="main-nav-bar" class="navbar navbar-default">
        <div class="container-fluid">

          <!-- Toggle buttons and brand -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="true" aria-controls="navbar">
              <span class="glyphicon glyphicon-option-vertical"></span>
            </button>

            <button type="button" class="navbar-toggle for-sidebar" data-toggle="offcanvas">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>

          </div>
          <!-- END Toggle buttons and brand -->

          <!-- Top navbar -->
          <div id="navbar" class="navbar-collapse collapse" aria-expanded="true" role="banner">
            <?php 
                      wp_nav_menu( 
                      array( 
                            'theme_location' => 'primary',
                            'container' => '',
                            'menu_class' => '', 
                            'menu_id' => '',
                            'menu'            => '',
                            'container_class' => '',
                            'container_id'    => '',
                            'echo'            => true,
                             'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                             'walker'            => new wp_bootstrap_navwalker(),
                            'before'          => '',
                            'after'           => '',
                            'link_before'     => '',
                            'link_after'      => '',
                            'items_wrap'      => '<ul class="nav navbar-nav navbar-right  %2$s">%3$s</ul>',
                            'depth'           => 0,        
                        )
                     ); ?>
          </div>
          <!-- END Top navbar -->

        </div>
      </nav>
      <!-- END Top navbar & branding -->

      <!-- Banner -->
      <div class="course-banner banner auto-size" style="background-color: #5cc7b2">
        <div class="container-fluid text-white">
          <h1><?php echo $args['course']->name; ?></h1>
          <h5><?php echo $args['getCourseSubheading'](); ?></h5>
          <a class='btn btn-success btn-lg' href="<?php echo $args['index-lesson']; ?>"><?php echo pll__('Start Course'); ?></a>
        </div>
      </div>
      <!-- END Banner -->

    </header>