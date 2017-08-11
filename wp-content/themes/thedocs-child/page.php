<?php 
    
global $post;
if(!get_template_part( VIEWS_PATH.'page/'.$post->post_name)){ ?>
    <?php get_header('boxed'); ?>
    <div class="container-fluid">
    <?php if(have_posts()){ the_post(); ?>
            <?php the_content(); ?>
    <?php } ?>
    </div>
    <?php get_footer(); ?>
<?php } ?>
