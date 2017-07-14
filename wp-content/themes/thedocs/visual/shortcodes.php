<?php 
global $pre_text;

$pre_text = 'VG ';




// Table of content
add_shortcode('table_content', 'table_content_func');
function table_content_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title'            =>      '',
        'id_content'      =>      '',
            ), $atts));
    ob_start(); 
     $images_url = wp_get_attachment_image_src($images,'');
    ?>  
 
    <li><a href="#<?php echo htmlspecialchars_decode($id_content); ?>"><?php echo htmlspecialchars_decode($title); ?></a></li>
            


<?php  return ob_get_clean();
} 

// Content Features
add_shortcode('features_content', 'features_content_func');
function features_content_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title'            =>      '',
        'subtitle'      =>      '',
        'icon'      =>      '',
            ), $atts));
    ob_start(); 
     $images_url = wp_get_attachment_image_src($images,'');
    ?>  
 
    <div class="col-md-4 col-sm-6">
                <div class="promo small-icon left">
                  <i class="<?php echo esc_attr($icon) ?>"></i>
                  <h3><?php echo htmlspecialchars_decode($title); ?></h3>
                  <p><?php echo htmlspecialchars_decode($subtitle); ?></p>
                </div>
              </div>
            


<?php  return ob_get_clean();
} 

// callout
add_shortcode('callout', 'callout_func');
function callout_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title'            =>      '',
        'subtitle'      =>      '',
            ), $atts));
    ob_start(); 
     $images_url = wp_get_attachment_image_src($images,'');
    ?>  
 
    <div class="callout callout-info" role="alert">
              <h4><?php echo htmlspecialchars_decode($title); ?></h4>
              <p><?php echo htmlspecialchars_decode($subtitle); ?></p>
            </div>
            


<?php  return ob_get_clean();
} 


// Variations
add_shortcode('variations', 'variations_func');
function variations_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title'            =>      '',
        'subtitle'      =>      '',
        'images' => '',
        'link' => '',
            ), $atts));
    ob_start(); 
     $images_url = wp_get_attachment_image_src($images,'');
    ?>  
 
    <div class="promo">
                  <img class="bordered" src="<?php echo esc_url($images_url[0]); ?>" alt="sample1">
                  <h3><?php echo htmlspecialchars_decode($title); ?></h3>
                  <a class="btn btn-teal" href="<?php echo esc_url($link); ?>"><?php echo htmlspecialchars_decode($subtitle); ?></a>
                </div>
            


<?php  return ob_get_clean();
} 


// Subtitle
add_shortcode('subtitle', 'subtitle_func');
function subtitle_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title'            =>      '',
        'subtitle'      =>      '',
        'id' => '',
            ), $atts));
    ob_start(); 
     $images_url = wp_get_attachment_image_src($images,'');
    ?>  
 
    <h3 id="<?php echo htmlspecialchars_decode($id); ?>"><?php echo htmlspecialchars_decode($title); ?></h3>
            <p><?php echo htmlspecialchars_decode($subtitle); ?></p>
            


<?php  return ob_get_clean();
} 

// Skins
add_shortcode('skins', 'skins_func');
function skins_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title'            =>      '',
        'subtitle'      =>      '',
        'images' => '',
            ), $atts));
    ob_start(); 
     $images_url = wp_get_attachment_image_src($images,'');
    ?>  

                <div class="promo">
                  <img class="bordered" src="<?php echo esc_url($images_url[0]); ?>" alt="default">
                  <h3><?php echo htmlspecialchars_decode($title); ?></h3>
                  <a class="btn btn-purple" data-skin="default" href="#"><?php echo htmlspecialchars_decode($subtitle); ?></a>
                </div>


<?php  return ob_get_clean();
} 

// Colors
add_shortcode('colors', 'colors_func');
function colors_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title'            =>      '',
        'subtitle'      =>      '',
        'images' => '',
            ), $atts));
    ob_start(); 
     $images_url = wp_get_attachment_image_src($images,'');
    ?>  
                <div class="promo">
                  <img class="bordered" src="<?php echo esc_url($images_url[0]); ?>" alt="default">
                  <h3><?php echo htmlspecialchars_decode($title); ?></h3>
                  <p><?php echo htmlspecialchars_decode($subtitle); ?></p>
                </div>


<?php  return ob_get_clean();
} 


// Variations
add_shortcode('sidebar', 'sidebar_func');
function sidebar_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title'            =>      '',
        'subtitle'      =>      '',
        'images' => '',
        'button' => '',
        'link' => '',
            ), $atts));
    ob_start(); 
     $images_url = wp_get_attachment_image_src($images,'');
    ?>  
 
    <div class="promo">
                  <img class="bordered" src="<?php echo esc_url($images_url[0]); ?>" alt="default">
                  <h3><?php echo htmlspecialchars_decode($title); ?></h3>
                  <p><?php echo htmlspecialchars_decode($subtitle); ?></p>
                  <a class="btn btn-purple" href="<?php echo esc_url($link); ?>"><?php echo htmlspecialchars_decode($button); ?></a>
                </div>
            


<?php  return ob_get_clean();
} 

// Codeview1
add_shortcode('codeview1', 'codeview1_func');
function codeview1_func($atts, $content = null){
    extract(shortcode_atts(array(
        'subtitle'      =>      '',
        'images' => '',
            ), $atts));
    ob_start(); 
     $images_url = wp_get_attachment_image_src($images,'');
    ?>  
    <div class="code-preview">
     <figure>
                  <img src="<?php echo esc_url($images_url[0]); ?>" alt="image test">
                  <figcaption><?php echo htmlspecialchars_decode($subtitle); ?></figcaption>
                </figure>    
    </div>               


<?php  return ob_get_clean();
} 

// Codeview2
add_shortcode('codeview2', 'codeview2_func');
function codeview2_func($atts, $content = null){
    extract(shortcode_atts(array(
        'style'      =>      '',
        'images' => '',
            ), $atts));
    ob_start(); 
     $images_url = wp_get_attachment_image_src($images,'');
    ?>  
    <div class="code-preview">
                <img class="<?php echo htmlspecialchars_decode($style); ?> img-responsive " src="<?php echo esc_url($images_url[0]); ?>" alt="shadowed image">
              </div>            


<?php  return ob_get_clean();
} 

// Codeview3
add_shortcode('codeview3', 'codeview3_func');
function codeview3_func($atts, $content = null){
    extract(shortcode_atts(array(
        'images' => '',
            ), $atts));
    ob_start(); 
     $images_url = wp_get_attachment_image_src($images,'');
    ?>  

              <div class="code-preview">

                <div class="row">
                  <div class="col-md-4">
                    <img class="img-responsive img-rounded" src="<?php echo esc_url($images_url[0]); ?>" alt="image">
                  </div>

                  <div class="col-md-4">
                    <img class="img-responsive img-circle" src="<?php echo esc_url($images_url[0]); ?>" alt="image">
                  </div>

                  <div class="col-md-4">
                    <img class="img-responsive img-thumbnail" src="<?php echo esc_url($images_url[0]); ?>" alt="image">
                  </div>
                </div>

              </div>          


<?php  return ob_get_clean();
} 

// Carousel1
add_shortcode('carousel1', 'carousel1_func');
function carousel1_func($atts, $content = null){
    extract(shortcode_atts(array(
        'images' => '',
            ), $atts));
    ob_start(); 
     $images_url = wp_get_attachment_image_src($images,'');
    ?>  

              <div class="code-preview">

                <div id="carousel1" class="carousel slide">
                  <!-- Indicators -->
                  <ol class="carousel-indicators">
                    <li data-target="#carousel1" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel1" data-slide-to="1"></li>
                    <li data-target="#carousel1" data-slide-to="2"></li>
                  </ol>

                  <!-- Wrapper for slides -->
                  <div class="carousel-inner" role="listbox">
                    <div class="item active">
                      <img src="<?php echo esc_url($images_url[0]); ?>" alt="">
                    </div>

                    <div class="item">
                      <img src="<?php echo esc_url($images_url[0]); ?>" alt="">
                    </div>

                    <div class="item">
                      <img src="<?php echo esc_url($images_url[0]); ?>" alt="">
                    </div>
                    
                  </div>

                  <!-- Controls -->
                  <a class="left carousel-control" href="#carousel1" role="button" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                  </a>
                  <a class="right carousel-control" href="#carousel1" role="button" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                  </a>
                </div>

              </div>     


<?php  return ob_get_clean();
} 

// Carousel2
add_shortcode('carousel2', 'carousel2_func');
function carousel2_func($atts, $content = null){
    extract(shortcode_atts(array(
        'images' => '',
            ), $atts));
    ob_start(); 
     $images_url = wp_get_attachment_image_src($images,'');
    ?>  

              <div class="code-preview">

                <div id="carousel2" class="carousel slide indicators-out">
                  <!-- Indicators -->
                  <ol class="carousel-indicators">
                    <li data-target="#carousel2" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel2" data-slide-to="1"></li>
                    <li data-target="#carousel2" data-slide-to="2"></li>
                  </ol>

                  <!-- Wrapper for slides -->
                  <div class="carousel-inner" role="listbox">
                    <div class="item active">
                      <img src="<?php echo esc_url($images_url[0]); ?>" alt="">
                    </div>

                    <div class="item">
                      <img src="<?php echo esc_url($images_url[0]); ?>" alt="">
                    </div>

                    <div class="item">
                      <img src="<?php echo esc_url($images_url[0]); ?>" alt="">
                    </div>
                  </div>

                </div>

              </div>


<?php  return ob_get_clean();
} 