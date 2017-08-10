<!-- Footer -->
<?php $redux_demo = get_option('redux_demo');?>
    <footer class="site-footer">
      <div class="container">
        <a id="scroll-up" href="#"><i class="fa fa-angle-up"></i></a>

        <div class="row">
          <div class="col-md-6 col-sm-6">
            <p><?php if(isset($redux_demo['footer_template'])){?>
                        <?php echo htmlspecialchars_decode(esc_attr($redux_demo['footer_template'])); ?>
                        <?php }else{?>
                        <?php echo esc_html__( 'Copyright &copy; 2015. All right reserved', 'thedocs' );
                        }
                        ?></p>
          </div>
          <div class="col-md-6 col-sm-6">
            <ul class="footer-menu">
            <?php 
                      wp_nav_menu( 
                      array( 
                            'theme_location' => 'footer-menu',
                            'container' => '',
                            'menu_class' => '', 
                            'menu_id' => '',
                            'menu'            => '',
                            'container_class' => '',
                            'container_id'    => '',
                            'echo'            => true,
                             'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                             'walker'            => new wp_bootstrap_navwalker(),
                            'before'          => '',
                            'after'           => '',
                            'link_before'     => '',
                            'link_after'      => '',
                            'items_wrap'      => '<ul class="footer-menu  %2$s">%3$s</ul>',
                            'depth'           => 0,        
                        )
                     ); ?>

            </ul>
          </div>
        </div>
      </div>
    </footer>
    <!-- END Footer -->

    <!-- Scripts -->
      <?php wp_footer();?>
  </body>
</html>
