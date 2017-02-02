<!DOCTYPE html>
<?php 

$companyLogo = get_option('4gacademy_op-company_logo');
$companyFavicon = get_option('4gacademy_op-company_favicon');

$postId = get_the_ID();
$bannerURL = get_post_meta( $postId, 'wpcf-banner_url',true);
$bannerHeading = get_post_meta( $postId, 'wpcf-banner_heading',true);
$bannerSubHeading = get_post_meta( $postId, 'wpcf-banner_subheading',true);
$bannerButton = get_post_meta( $postId, 'wpcf-banner_button',true);

?>

<html lang="en">
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <!-- Styles -->
    <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
        ?>
    <!-- Favicons-->
    <link rel="shortcut icon" href="<?php if(isset($companyFavicon)) {?><?php echo esc_url($companyFavicon); ?><?php }?>" type="image/x-icon"/>
    <?php }?>
      <?php wp_head();?>

    <!-- Fonts -->
    <!-- Favicons -->
    
    </head>

  <body <?php body_class(); ?>>

    <header class="site-header sticky navbar-fullwidth navbar-transparent">

      <!-- Top navbar & branding -->
      <nav class="navbar navbar-default">
        <div class="container">

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

            <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <?php  if($companyLogo and $companyLogo!= ''){ ?>
                <img alt="" src="<?php echo esc_url($companyLogo); ?>" class="logo-padding"/>
                <?php }else{ ?>
                <img src="<?php echo get_template_directory_uri();?>/assets/img/logo.png" class="logo-padding" />
                <?php } ?>
          </a>
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
      <?php if(isset($bannerURL) && $bannerURL != ''){?>
          <div class="banner banner-full-height overlay-black" style="background-image: url(<?php echo esc_url($bannerURL); ?>);">
        <?php }else{?>
          <div class="banner banner-full-height overlay-black" style="background-image: url(<?php echo get_template_directory_uri();?>/assets/img/banner1.jpg);">
        <?php }?>
          <div class="container text-center">
            <h1><?php echo esc_attr($bannerHeading);?></h1>
            <h5><?php echo htmlspecialchars_decode($bannerSubHeading);?></h5>
            <br><br><br><br>
            <p><a class="btn btn-white btn-lg btn-outline" href="#getting_started" role="button">
                <?php if(isset($bannerButton) && $bannerButton != ''){?>
                <?php echo $bannerButton; ?>
                <?php } else { echo "Your button label here"; }?>
                </a></p>
          </div>
      </div>
      <!-- END Banner -->

</header>