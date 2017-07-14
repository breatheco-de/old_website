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
    <?php }?>
      <?php wp_head();?>

      <!-- Favicons -->
    
    </head>

  <body <?php body_class(); ?> data-spy="scroll" data-target=".sidebar" data-offset="200">

    <header class="site-header sticky navbar-transparent">

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
                <?php $redux_demo = get_option('redux_demo'); if(isset($redux_demo['logo']['url'])){?>
                <?php  if($redux_demo['logo']['url'] != ''){ ?>
                <img alt="<?php echo esc_html__( 'logo', 'thedocs' );?>" src="<?php echo esc_url($redux_demo['logo']['url']); ?>" class="logo-padding"/>
                <?php }else{ ?>
                <img  src="<?php echo get_template_directory_uri();?>/assets/img/logo.png" alt="<?php echo esc_html__( 'logo', 'thedocs' );?>" class="logo-padding" />
                <?php }}else{?>
                <img  src="<?php echo get_template_directory_uri();?>/assets/img/logo.png" alt="<?php echo esc_html__( 'logo', 'thedocs' );?>" class="logo-padding" />
                <?php }?>
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
      <div class="banner auto-size background-color1" >
        <div class="container text-white">
          <h1><?php echo htmlspecialchars_decode($redux_demo['header_page_text']);?></h1>
          <h5><?php echo htmlspecialchars_decode($redux_demo['header_page_subtext']);?></h5>
        </div>
      </div>
      <!-- END Banner -->

    </header>