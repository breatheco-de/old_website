<?php 
global $post; 
if(!get_template_part( VIEWS_PATH.'post/'.$post->post_name)){ ?>
    <div class="container-fluid">
    <?php if(have_posts()){ the_post(); ?>
            <?php the_content(); ?>
    <?php } ?>
    </div>
    <?php wp_footer(); ?>
<?php } ?>