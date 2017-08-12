<?php 
    
global $post;
$result = file_exists(get_template_directory().'-child/src/php/view/page/'.$post->post_name.'.php');
if($result) get_template_part( VIEWS_PATH.'page/'.$post->post_name);
else { ?>
    <div class="container-fluid">
    <?php if(have_posts()){ the_post(); ?>
            <?php the_content(); ?>
    <?php } ?>
    </div>
    <?php wp_footer(); ?>
<?php } ?>
