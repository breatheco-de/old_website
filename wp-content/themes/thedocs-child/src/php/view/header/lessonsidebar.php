<?php do_action( 'get_header'); ?>
<!DOCTYPE html>
<?php 
$redux_demo = get_option('redux_demo'); ?>
<html lang="en">
  <head>
    <?php include(locate_template(VIEWS_PATH.'_partials/script-tagmanager-head.php')); ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <!-- Styles -->
    <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
        ?>
    <!-- Favicons-->
    <link rel="shortcut icon" href="<?php if(isset($redux_demo['favicon']['url'])){?><?php echo esc_url($redux_demo['favicon']['url']); ?><?php }?>" type="image/x-icon"/>
    <?php }?>
      <?php wp_head();?>
      <!-- Favicons -->
    
    </head>

  <body>
  <?php include(locate_template(VIEWS_PATH.'_partials/script-tagmanager-body.php')); ?>
  <?php if(!isset($_GET['plain'])) { ?>
    <!-- Sidebar -->
    <?php include(locate_template(VIEWS_PATH.'_partials/template-course-sidebar.php')); ?>
    <!-- END Sidebar -->

    <!-- Top navbar & branding -->
    <?php include(locate_template(VIEWS_PATH.'_partials/lesson-top-bar.php')); ?>
    <!-- END Top navbar & branding -->
  <?php } ?>
