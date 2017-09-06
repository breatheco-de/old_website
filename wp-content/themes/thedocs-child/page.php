<?php 
    
global $post;
global $polylang;
$translationIds = $polylang->model->get_translations('page', $post->ID);
$englishPost = new WP_Query(['p' => $translationIds['en'], 'post_type' => 'page', 'lang' => 'en']);
if(count($englishPost->posts) != 1)
{
  global $wp_query;
  $wp_query->set_404();
  status_header( 404 );
  get_template_part( 404 ); exit();
}
else
{
    $result = file_exists(get_template_directory().'-child/src/php/view/page/'.$englishPost->posts[0]->post_name.'.php');
    if($result){ 
        get_template_part( VIEWS_PATH.'page/'.$englishPost->posts[0]->post_name);
    } else { ?>
        
        <div class="container-fluid">
        <?php if(have_posts()){ the_post(); ?>
                <?php the_content(); ?>
        <?php } ?>
        </div>
        <?php wp_footer(); ?>
    <?php }
    
}
