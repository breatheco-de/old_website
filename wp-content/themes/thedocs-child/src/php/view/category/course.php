<?php
/*
 * Template Name Posts: Taxonomy Course
 * Description: A Page Template with a Page Builder design.
 */
get_template_part(VIEWS_PATH.'header/course'); 
$args = WPAS\Controller\WPASController::getViewData();
$menuParents = $args['createCourseHierarchy']($args['menu_name']);
?>
    <main class="container-fluid">
    <div class="row" style="margin-left: 0px;">
    <article class="main-content" role="main">
      <?php echo term_description(); ?>

      <ol class="toc">
        <?php foreach ( $menuParents as $menu_item ) {
              $title = $menu_item["title"];
              $url = $menu_item["url"];
        ?>
        <li>
          <a href="<?php echo $url; ?>"><?php echo $title; ?></a>
          <?php if(count($menu_item["childs"]) > 0){ ?>
          <ol>
            <?php foreach ( $menu_item["childs"] as $child_item ) { ?>
            <li>
              <a href="<?php echo $url.$child_item["url"]; ?>"><?php echo $child_item["title"]; ?></a>
              <ol>
                <?php foreach ( $child_item["childs"] as $grandchild_item ) { ?>
                <li><a href="<?php echo $url.$grandchild_item["url"]; ?>"><?php echo $grandchild_item["title"]; ?></a></li>
                <?php } ?>
              </ol>
          <?php } ?>
            </li>
          </ol>
          <?php } ?>
        </li>
        <?php } ?>
      </ol>

    </article>


<?php get_footer('box-sidebar'); ?>