<!DOCTYPE html>
<?php 
$redux_demo = get_option('redux_demo'); ?>
<html lang="en">
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <!-- Styles -->
    <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
        ?>
    <!-- Favicons-->
    <link rel="shortcut icon" href="<?php if(isset($redux_demo['favicon']['url'])){?><?php echo esc_url($redux_demo['favicon']['url']); ?><?php }?>" type="image/x-icon"/>
    <link rel='stylesheet' id='vc_tta_style-css'  href='/wp-content/plugins/js_composer/assets/css/js_composer_tta.min.css?ver=5.1.1' type='text/css' media='all' />
    <?php }?>
      <?php wp_head();?>
      <!-- Favicons -->
    
    </head>

  <body>

    <!-- Sidebar -->
    <?php include(locate_template(VIEWS_PATH.'_partials/template-course-sidebar.php')); ?>
    <!-- END Sidebar -->

    <!-- Top navbar & branding -->
    <?php include(locate_template(VIEWS_PATH.'_partials/lesson-top-bar.php')); ?>
    <!-- END Top navbar & branding -->
