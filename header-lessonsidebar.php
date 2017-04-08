<!DOCTYPE html>
<?php 
$redux_demo = get_option('redux_demo'); ?>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

    <!-- Sidebar -->
    <?php include(locate_template('cp-template-parts/template-course-sidebar.php')); ?>
    <!-- END Sidebar -->

    <!-- Top navbar & branding -->
    <?php include(locate_template('cp-template-parts/template-top-bar.php')); ?>
    <!-- END Top navbar & branding -->
