<?php 
global $post; 
$result = file_exists(get_template_directory().'-child/src/php/view/post/'.$post->post_type.'.php');
if($result) get_template_part( VIEWS_PATH.'post/'.$post->post_type);
else{
?>
    <div class="container-fluid">
    <?php if(have_posts()){ the_post(); ?>
            <?php the_content(); ?>
    <?php } ?>
    </div>
    <?php wp_footer(); ?>
<?php } ?>