<?php get_header(); ?>

<main class="container">
      <div class="row">

        <!-- Main content -->
        <div class="col-md-9 col-sm-9 main-content" role="main" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php 
                        while (have_posts()): the_post(); 
                    ?> 
          <article class="post" <?php post_class(); ?>>
            <header>
              <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
              <ul class="post-meta">
                <li><i>
                <?php if(isset($redux_demo['blog_cat'])){?>
                        <?php echo esc_attr($redux_demo['blog_cat']); ?>
                        <?php }else{?>
                        <?php echo esc_html__( 'Category:', 'thedocs' );
                        }
                        ?></i> <span><?php 
                                            // Show all category for post
                                            $i = 1; foreach((get_the_category()) as $category) { 
                                            if ($i == 1){echo ''; }else {echo ' , ';}
                                                echo '<a href="'.get_category_link($category->cat_ID).'"> '.$category->category_nicename . ' '.'</a>'; 
                                                
                                                $i++;
                                            } ?></span></li>
                <li><i><?php if(isset($redux_demo['blog_time'])){?>
                        <?php echo esc_attr($redux_demo['blog_time']); ?>
                        <?php }else{?>
                        <?php echo esc_html__( 'Date:', 'thedocs' );
                        }
                        ?></i> <span><?php the_time('F j, Y'); ?></span></li>
              </ul>
            </header>

            <?php if ( has_post_thumbnail() ) { ?>
            <div class="post-media">
              <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id());?>" alt="<?php the_title(); ?>">
            </div>
            <?php }?>

            <div class="blog-content">
            <?php the_content(); ?>
            <?php wp_link_pages(); ?>
            
            </div>

            <div class="post-tags">
              <p><strong><?php if(isset($redux_demo['blog_tag'])){?>
                        <?php echo esc_attr($redux_demo['blog_tag']); ?>
                        <?php }else{?>
                        <?php echo esc_html__( 'Tag:', 'thedocs' );
                        }
                        ?></strong></p>
              <?php the_tags( ); ?>
            </div>
          </article>
          <?php endwhile;?>

          <ul class="pager">
            <li class="previous"><?php previous_post_link( '%link', 'Previous entry' ); ?></li>
            <li class="next"><?php next_post_link( '%link', 'Next entry' ); ?></li>
          </ul>
          
          <?php           
                    if ( comments_open() || get_comments_number() ) {
                      comments_template();
                    }
                    ?>    

        </div>
        <!-- END Main content -->


        <!-- Sidebar -->
        <aside class="col-md-3 col-sm-3 sidebar">

          <?php get_sidebar();?>

        </aside>
        <!-- END Sidebar -->

      </div>
    </main>


<?php get_footer();?>