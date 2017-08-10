 <?php get_header();?> 

 <main class="container">
      <div class="row">
         <h2 class="text-align-center margin-bottom40" ><?php
                            /*
                             * Queue the first post, that way we know what author
                             * we're dealing with (if that is the case).
                             *
                             * We reset this later so we can run the loop properly
                             * with a call to rewind_posts().
                             */
                            the_post();

                            printf( esc_html__( 'All posts by %s', 'thedocs' ), get_the_author() );
                        ?></h2>

        <!-- Main content -->
        <div class="col-md-9 col-sm-9 main-content" role="main">
                    <?php 
                        while (have_posts()): the_post(); 
                    ?>  
          <article class="post">
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
              <p><?php if(isset($redux_demo['blog_excerpt'])){?>
                <?php echo esc_attr(thedocs_excerpt($redux_demo['blog_excerpt'])); ?>
                <?php }else{?>
                <?php echo esc_attr(thedocs_excerpt(30)); 
                }
                ?></p>
            </div>
            

            <p class="read-more">
              <a class="btn btn-teal btn-outline" href="<?php the_permalink();?>">
              <?php if(isset($redux_demo['continue_reading'])){?>
                        <?php echo esc_attr($redux_demo['continue_reading']); ?>
                        <?php }else{?>
                        <?php echo esc_html__( 'Continue reading', 'thedocs' );
                        }
                        ?></a>
            </p>
          </article>
          <?php endwhile;?>

          <ul class="pager">
            <?php thedocs_pagination(); ?>
          </ul>
          
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