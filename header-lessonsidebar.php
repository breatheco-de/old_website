<?php 
$postId = get_the_ID();
$terms = wp_get_post_terms($postId,'course');

if(count($terms)!=1) die('This lesson needs to be asigned to a course.');
else $course = $terms[0];

$menu_name = types_render_termmeta('course-sidebar-id',array( "term_id" => $course->term_id));
if(!$menu_name or $menu_name=='') die('There is no menu for the course taxonomy: '.$menu_name);

$menu = wp_get_nav_menu_object($menu_name);
$menu_items = wp_get_nav_menu_items($menu->term_id);

$menuParents = array();

foreach ( (array) $menu_items as $key => $menu_item ) {
  $id = $menu_item->ID;
  $title = $menu_item->title;
  $url = $menu_item->url;
  if(!$menu_item->menu_item_parent or $menu_item->menu_item_parent=='')
  {
    $menuParents[$id] = array("id"=>$id,"title"=>$title, "url"=>$url, "childs"=>array());
  }
  else
  {
    if(isset($menuParents[$menu_item->menu_item_parent]))
      $menuParents[$menu_item->menu_item_parent]["childs"][$id] = array("id"=>$id,"title"=>$title, "url"=>$url, "childs"=>array());
    else
      foreach ($menuParents as $parent){
        if(isset($parent["childs"][$menu_item->menu_item_parent]))
        {
          $menuParents[$parent["id"]]["childs"][$menu_item->menu_item_parent]["childs"][$id] = array("id"=>$id,"title"=>$title, "url"=>$url, "childs"=>array());
        }
      }
  }
} 

//die(print_r($menuParents));

?>
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

  <body>

    <!-- Sidebar -->
    <aside class="sidebar sidebar-boxed sidebar-dark">

      <a class="sidebar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <?php $redux_demo = get_option('redux_demo'); if(isset($redux_demo['logo']['url'])){?>
        <?php  if($redux_demo['logo']['url'] != ''){ ?>
        <img alt="<?php echo esc_html__( 'logo', 'thedocs' );?>" src="<?php echo esc_url($redux_demo['logo']['url']); ?>" class="logo-padding"/>
        <?php }else{ ?>
        <img  src="<?php echo get_template_directory_uri();?>/assets/img/logo.png" alt="<?php echo esc_html__( 'logo', 'thedocs' );?>" class="logo-padding" />
        <?php }}else{?>
        <img  src="<?php echo get_template_directory_uri();?>/assets/img/logo.png" alt="<?php echo esc_html__( 'logo', 'thedocs' );?>" class="logo-padding" />
        <?php }?>
      </a>

        <ul class="sidenav dropable sticky">
            <?php foreach ( $menuParents as $menu_item ) {
                  $title = $menu_item["title"];
                  $url = $menu_item["url"];
            ?>
              <li>
                <a title="<?php echo $title; ?>" href="<?php echo $url; ?>"><?php echo $title; ?></a>
                <?php if(count($menu_item["childs"]) > 0){ ?>
                      <ul>
                        <?php foreach ( $menu_item["childs"] as $child_item ) { ?>
                        <li>
                          <a title="<?php echo $child_item["title"]; ?>" href="<?php echo $child_item["url"]; ?>"><?php echo $child_item["title"]; ?></a>
                          <?php if(count($child_item["childs"]) > 0){ ?>
                                <ol>
                                  <?php foreach ( $child_item["childs"] as $grandchild_item ) { ?>
                                  <li>
                                    <a title="<?php echo $grandchild_item["title"]; ?>" href="<?php echo $grandchild_item["url"]; ?>"><?php echo $grandchild_item["title"]; ?></a>
                                  </li>
                                  <?php } ?>
                                </ol>
                          <?php } ?>
                        </li>
                        <?php } ?>
                      </ul>
                <?php } ?>
              </li>
            <?php } ?>
        </ul>

    </aside>
    <!-- END Sidebar -->


    <header class="site-header navbar-fullwidth">

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
      
    </header>