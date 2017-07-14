 <?php get_header();?> 

 <main class="container">
      <div class="row">
        <h2 class="text-align-center margin-bottom40" ><?php
                                if ( is_day() ) :
                                    printf( esc_html__( 'Daily Archives: %s', 'thedocs' ), get_the_date() );

                                elseif ( is_month() ) :
                                    printf( esc_html__( 'Monthly Archives: %s', 'thedocs' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'thedocs' ) ) );

                                elseif ( is_year() ) :
                                    printf( esc_html__( 'Yearly Archives: %s', 'thedocs' ), get_the_date( _x( 'Y', 'yearly archives date format', 'thedocs' ) ) );

                                else :
                                    esc_html_e( 'Archives', 'thedocs' );

                                endif;
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
              <?php the_post_thumbnail(); ?>
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