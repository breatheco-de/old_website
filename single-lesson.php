<?php
/*
 * Template Name Posts: Lesson Box Sidebar
 * Description: A Page Template with a Page Builder design.
 */
get_header('lessonsidebar'); 
?>
    <main class="container-fluid">
    <div class="row">
    <article class="main-content" role="main">

<?php if (have_posts()){ ?>
  
    <?php while (have_posts()) : the_post()?>
      <?php the_content(); ?>
    <?php endwhile; ?>
  
  <?php }else {
    echo 'Page Canvas For Page Builder'; 
  }?>
  </article>


<?php get_footer('box-sidebar'); ?>