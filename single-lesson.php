<?php
/*
 * Template Name Posts: Lesson Box Sidebar
 * Description: A Page Template with a Page Builder design.
 */

function get_lesson_assets($postId)
{
  $array_assets = array();
  //Empiezo a imprimir las proximas fechas de los cursos
  $args = array(
  'post_type'     => 'lesson-asset',
  'meta_key'      => '_wpcf_belongs_lesson_id',
  'posts_per_page'  =>  -1,
  'meta_value'      => $postId
  );
  $query_assets = new WP_Query($args);
  $cont = 0;
  while($query_assets->have_posts()) : $query_assets->the_post();
    $assetId = get_the_ID();
    $description = get_the_content();
    $title = get_the_title();
    $assetUrl = get_post_meta( $assetId, 'wpcf-asset_url', true);
    $assetType = get_post_meta( $assetId, 'wpcf-asset_type', true);
    $assetPreview = get_post_meta( $assetId, 'wpcf-asset_preview', true);

    $asset = array(
      "title"=> $title, 
      "description"=>$description ,
      "url"=> $assetUrl ,
      "type"=> $assetType, 
      "preview"=> $assetPreview
      );

    array_push($array_assets,$asset);
  endwhile; 
  wp_reset_postdata();

  return $array_assets;
}

get_header('lessonsidebar'); 
?>
    <main class="container-fluid">
    <div class="row" style="margin-left: 0px;">
    <article class="main-content" role="main">

<?php if (have_posts()){ 
          the_post();
          $postId = get_the_ID();
          $assets = get_lesson_assets($postId);
          the_content();

          if(count($assets)>0){
        ?>

          <section id="lesson-assets">
            <h2 id="assets"><a href="#assets">Assets for this lesson</a></h2>
            <p>We know is hard and some times overwhelming, we have prepared the following materials to help you.</p>
            <ul class="step-text">
          <?php foreach ($assets as $asset){ ?>
              <li>
                <img class="asset-preview-img" src="<?php echo $asset["preview"]; ?>">
                <h5><?php echo $asset["title"]; ?></h5>
                <p><?php echo $asset["description"]; ?></p>
                <p><a class="btn btn-teal" href="<?php echo $asset["url"]; ?>">Download</a></p>
              </li>
          <?php } ?>
            </ul>
          </section>

        <?php } ?>

  <?php }else {
    echo 'Page Canvas For Page Builder'; 
  }?>
  </article>


<?php get_footer('box-sidebar'); ?>