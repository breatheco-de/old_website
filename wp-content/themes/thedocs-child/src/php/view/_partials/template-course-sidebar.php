<?php 

$args = WPAS\Controller\WPASController::getViewData();
$menuParents = $args['createCourseHierarchy']($args['menu_name']);

$currentURL = strtok(strtok($_SERVER["REQUEST_URI"],'?'),'#');


$logo_url = types_render_termmeta('course-logo',array( "term_id" => $course->term_id, "url"=>true, "size"=>'thumbnail', 'proportional'=>true));
if(!$logo_url or $logo_url=='') $logo_url = '<?php echo get_stylesheet_directory_uri();?>/assets/img/logo.png';

?>

	<aside class="sidebar sidebar-boxed sidebar-dark toggled">
      <a id="menu-toggle" style="visibility: hidden;" href="#"><i class="fa fa-bars" aria-hidden="true"></i> Index</a>

      <a class="sidebar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <img alt="<?php echo esc_html__( 'logo', 'thedocs' );?>" src="<?php echo $logo_url; ?>" class="logo-padding"/>
      </a>

        <ul class="sidenav dropable sticky">
            <?php if(empty($menuParents)){ ?>
            <li><a>No menu assigned for this lesson</a></li>
            <?php } ?>
            <?php foreach ( $menuParents as $menu_item ) {
                  $title = $menu_item["title"];
                  $url = $menu_item["url"];

                  $active = false;
                  if($currentURL == $url) $active = true;
            ?>
              <li>
                <a title="<?php echo $title; ?>" href="<?php echo $url; ?>"><?php echo $title; ?></a>
                <?php if(count($menu_item["childs"]) > 0){ ?>
                      <ul>
                        <?php foreach ( $menu_item["childs"] as $child_item ) { ?>
                        <li>
                          <a title="<?php echo $child_item["title"]; ?>" href="<?php echo (!$active) ? $url.$child_item["url"] : $child_item["url"]; ?>"><?php echo $child_item["title"]; ?></a>
                          <?php if(count($child_item["childs"]) > 0){ ?>
                                <ol>
                                  <?php foreach ( $child_item["childs"] as $grandchild_item ) { ?>
                                  <li>
                                    <a title="<?php echo $grandchild_item["title"]; ?>" href="<?php echo (!$active) ? $url.$grandchild_item["url"] : $grandchild_item["url"]; ?>"><?php echo $grandchild_item["title"]; ?></a>
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