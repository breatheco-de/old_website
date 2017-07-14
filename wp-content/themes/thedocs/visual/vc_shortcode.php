<?php 
global $pre_text;

$pre_text = 'VG ';



//add


// Table of content
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__($pre_text."Table of content", 'thedocs'),
   "base" => "table_content",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Text Title. ", 'thedocs'),
         "param_name" => "title",
         "value" => "",
         "description" => esc_html__("Title", 'thedocs')
      ),
      array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("ID content.", 'thedocs'),
         "param_name" => "id_content",
         "value" => "",
         "description" => esc_html__("input ID content..", 'thedocs')
      ),
      
      

    )));
}


// Content Features
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__($pre_text."Content Features", 'thedocs'),
   "base" => "features_content",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Text Title. ", 'thedocs'),
         "param_name" => "title",
         "value" => "",
         "description" => esc_html__("Title", 'thedocs')
      ),
      array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Subtitle.", 'thedocs'),
         "param_name" => "subtitle",
         "value" => "",
         "description" => esc_html__("Subtitle.", 'thedocs')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Icon.", 'thedocs'),
         "param_name" => "icon",
         "value" => "",
         "description" => esc_html__("input Icon.", 'thedocs')
      ),
      
      

    )));
}

// callout
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__($pre_text."Callout info", 'thedocs'),
   "base" => "callout",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Text Title. ", 'thedocs'),
         "param_name" => "title",
         "value" => "",
         "description" => esc_html__("Title", 'thedocs')
      ),
      array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Subtitle.", 'thedocs'),
         "param_name" => "subtitle",
         "value" => "",
         "description" => esc_html__("Subtitle.", 'thedocs')
      ),
      
      

    )));
}

// Variations
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__($pre_text."Variations", 'thedocs'),
   "base" => "variations",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Text Title. ", 'thedocs'),
         "param_name" => "title",
         "value" => "",
         "description" => esc_html__("Title", 'thedocs')
      ),
      array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Subtitle.", 'thedocs'),
         "param_name" => "subtitle",
         "value" => "",
         "description" => esc_html__("Subtitle.", 'thedocs')
      ),
      array(
            'type'        => 'attach_image',
            'heading'     => esc_html__( 'Images', 'js_composer' ),
            'param_name'  => 'images',
            'value'       => '',
            'description' => esc_html__( 'Select images from media library.', 'js_composer' )
        ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Link", 'thedocs'),
         "param_name" => "link",
         "value" => "",
         "description" => esc_html__("Link", 'thedocs')
      ),
      
      

    )));
}


// Subtitle
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__($pre_text."Subtitle", 'thedocs'),
   "base" => "subtitle",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Text Title. ", 'thedocs'),
         "param_name" => "title",
         "value" => "",
         "description" => esc_html__("Title", 'thedocs')
      ),
      array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Subtitle.", 'thedocs'),
         "param_name" => "subtitle",
         "value" => "",
         "description" => esc_html__("Subtitle.", 'thedocs')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("ID", 'thedocs'),
         "param_name" => "id",
         "value" => "",
         "description" => esc_html__("Input ID", 'thedocs')
      ),
      
      

    )));
}


// Skins
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__($pre_text."Skins", 'thedocs'),
   "base" => "skins",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Text Title. ", 'thedocs'),
         "param_name" => "title",
         "value" => "",
         "description" => esc_html__("Title", 'thedocs')
      ),
      array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Subtitle.", 'thedocs'),
         "param_name" => "subtitle",
         "value" => "",
         "description" => esc_html__("Subtitle.", 'thedocs')
      ),
      array(
            'type'        => 'attach_image',
            'heading'     => esc_html__( 'Images', 'js_composer' ),
            'param_name'  => 'images',
            'value'       => '',
            'description' => esc_html__( 'Select images from media library.', 'js_composer' )
        ),
      
      

    )));
}


// Colors
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__($pre_text."Colors", 'thedocs'),
   "base" => "colors",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Text Title. ", 'thedocs'),
         "param_name" => "title",
         "value" => "",
         "description" => esc_html__("Title", 'thedocs')
      ),
      array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Subtitle.", 'thedocs'),
         "param_name" => "subtitle",
         "value" => "",
         "description" => esc_html__("Subtitle.", 'thedocs')
      ),
      array(
            'type'        => 'attach_image',
            'heading'     => esc_html__( 'Images', 'js_composer' ),
            'param_name'  => 'images',
            'value'       => '',
            'description' => esc_html__( 'Select images from media library.', 'js_composer' )
        ),
      
      

    )));
}


// Sidebar
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__($pre_text."Sidebar", 'thedocs'),
   "base" => "sidebar",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Text Title. ", 'thedocs'),
         "param_name" => "title",
         "value" => "",
         "description" => esc_html__("Title", 'thedocs')
      ),
      array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Subtitle.", 'thedocs'),
         "param_name" => "subtitle",
         "value" => "",
         "description" => esc_html__("Subtitle.", 'thedocs')
      ),
      array(
            'type'        => 'attach_image',
            'heading'     => esc_html__( 'Images', 'js_composer' ),
            'param_name'  => 'images',
            'value'       => '',
            'description' => esc_html__( 'Select images from media library.', 'js_composer' )
        ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Button Title. ", 'thedocs'),
         "param_name" => "button",
         "value" => "",
         "description" => esc_html__("Title", 'thedocs')
      ),
      array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Link", 'thedocs'),
         "param_name" => "link",
         "value" => "",
         "description" => esc_html__("Link", 'thedocs')
      ),
      

    )));
}


// Codeview1
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__($pre_text."Codeview1", 'thedocs'),
   "base" => "codeview1",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
      array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__("Subtitle.", 'thedocs'),
         "param_name" => "subtitle",
         "value" => "",
         "description" => esc_html__("Subtitle.", 'thedocs')
      ),
      array(
            'type'        => 'attach_image',
            'heading'     => esc_html__( 'Images', 'js_composer' ),
            'param_name'  => 'images',
            'value'       => '',
            'description' => esc_html__( 'Select images from media library.', 'js_composer' )
        ),

    )));
}

// Codeview2
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__($pre_text."Codeview2", 'thedocs'),
   "base" => "codeview2",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
      array(
            'type'        => 'attach_image',
            'heading'     => esc_html__( 'Images', 'js_composer' ),
            'param_name'  => 'images',
            'value'       => '',
            'description' => esc_html__( 'Select images from media library.', 'js_composer' )
        ),
            array(
       'type' => 'dropdown',
       'heading' => "style",
       'param_name' => 'style',
       'value' => array( "center-block img-shadow ", "img-rounded", "img-circle","img-thumbnail" ),
       'description' => __( "Select style do you want", "thedocs" )
   ),

    )));
}



// Codeview3
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__($pre_text."Codeview3", 'thedocs'),
   "base" => "codeview3",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
      array(
            'type'        => 'attach_image',
            'heading'     => esc_html__( 'Images', 'js_composer' ),
            'param_name'  => 'images',
            'value'       => '',
            'description' => esc_html__( 'Select images from media library.', 'js_composer' )
        ),

    )));
}

// Carousel1
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__($pre_text."carousel1", 'thedocs'),
   "base" => "carousel1",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
      array(
            'type'        => 'attach_image',
            'heading'     => esc_html__( 'Images', 'js_composer' ),
            'param_name'  => 'images',
            'value'       => '',
            'description' => esc_html__( 'Select images from media library.', 'js_composer' )
        ),

    )));
}

// Carousel2
if(function_exists('vc_map')){
   vc_map( array(
   "name" => esc_html__($pre_text."carousel2", 'thedocs'),
   "base" => "carousel2",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
      array(
            'type'        => 'attach_image',
            'heading'     => esc_html__( 'Images', 'js_composer' ),
            'param_name'  => 'images',
            'value'       => '',
            'description' => esc_html__( 'Select images from media library.', 'js_composer' )
        ),

    )));
}