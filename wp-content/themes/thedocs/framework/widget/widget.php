<?php class Download_Widget extends WP_Widget
{

  public function __construct()
  {
    parent::__construct(
      'download-widget',
      'Download Widget',
      array(
        'description' => 'Download Widget'
      )
    );
  }

  public function widget( $args, $instance )
  {
    // basic output just for this example

    echo'<div class="single-sidebar-widget">
          <div class="sec-title">
            <h2><span>'.esc_attr($instance['title']).'</span></h2>
          </div>
          <div class="dwnld-broucher">
            <img src="'.esc_url($instance['image_uri']).'" alt="Awesome Image"/>
            <a href="'.esc_attr($instance['link']).'">'.esc_attr($instance['text']).'  <i class="fa '.esc_attr($instance['icon']).'"></i></a>  
          </div>
          </div>
          ';

   
  }

  public function form( $instance )
  {
    // removed the for loop, you can create new instances of the widget instead
    ?>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title</label><br />
      <input type="text" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('image_uri')); ?>">Image</label><br />
      <input type="text" class="img" name="<?php echo esc_attr($this->get_field_name('image_uri')); ?>" id="<?php echo esc_attr($this->get_field_id('image_uri')); ?>" value="<?php echo esc_url($instance['image_uri']); ?>" />
      <input type="button" class="select-img" value="Select Image" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('text')); ?>">Text</label><br />
      <input type="text" name="<?php echo esc_attr($this->get_field_name('text')); ?>" id="<?php echo esc_attr($this->get_field_id('text')); ?>" value="<?php echo esc_attr($instance['text']); ?>" class="widefat" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('link')); ?>">Link</label><br />
      <input type="text" name="<?php echo esc_attr($this->get_field_name('link')); ?>" id="<?php echo esc_attr($this->get_field_id('link')); ?>" value="<?php echo esc_attr($instance['link']); ?>" class="widefat" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('icon')); ?>">Class Icon</label><br />
      <input type="text" name="<?php echo esc_attr($this->get_field_name('icon')); ?>" id="<?php echo esc_attr($this->get_field_id('icon')); ?>" value="<?php echo esc_attr($instance['icon']); ?>" class="widefat" />
    </p>
    
    <?php
  }


} 
// end class

// init the widget
add_action( 'widgets_init', create_function('', 'return register_widget("Download_Widget");') );







class Request_Widget extends WP_Widget
{

  public function __construct()
  {
    parent::__construct(
      'request-widget',
      'Request Widget',
      array(
        'description' => 'Foom Request Widget'
      )
    );
  }

  public function widget( $args, $instance )
  {
    // basic output just for this example
 $redux_demo = get_option('redux_demo');
              ?>
              <div class="single-sidebar-widget">
                <div class="sec-title">
                  <h2><span><?php echo esc_attr($instance['title']);?></span></h2>
                </div>
                <form action="<?php echo esc_url($instance['link']);?>" class="contact-form">
                  <p><input type="text" name="name" placeholder="Name"></p>
                  <p><input type="text" name="email" placeholder="Email*"></p>
                  <select class="select-menu" name="selectMenu">
                    <option value="default">Choose Something...</option>  
                    <option value="Ware Housing">Ware Housing</option>  
                    <option value="Ware Housing">Ware Housing</option>  
                    <option value="Ware Housing">Ware Housing</option>  
                    <option value="Ware Housing">Ware Housing</option>  
                    <option value="Ware Housing">Ware Housing</option>  
                  </select>
                  <p><input type="text" name="subject" placeholder="Subject"></p>
                  <p><textarea name="message" placeholder="Message"></textarea></p>
                  <button type="submit" class="thm-btn">Submit Now <i class="fa fa-arrow-right"></i></button>
                </form>
              </div>


              <?php
   
  }

  public function form( $instance )
  {
    // removed the for loop, you can create new instances of the widget instead
    ?>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title</label><br />
      <input type="text" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('link')); ?>">Link page send mail</label><br />
      <input type="text" name="<?php echo esc_attr($this->get_field_name('link')); ?>" id="<?php echo esc_attr($this->get_field_id('link')); ?>" value="<?php echo esc_attr($instance['link']); ?>" class="widefat" />
    </p>
    
    <?php
  }


} 
// end class

// init the widget
add_action( 'widgets_init', create_function('', 'return register_widget("Request_Widget");') );




