<?php

require('forms.autoload.php');

class GravityFormSettings {

  function __construct() {
    
    if(!is_plugin_active('gravityforms/gravityforms.php')) throw new \Exception('The plugin GravityForms is required, please install it.');
    
    add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );
    add_filter("gform_form_settings", array($this,"pbc_gf_add_class_to_button_ui"), 10, 2);
    add_filter( 'gform_pre_form_settings_save', array($this,"pbc_gf_add_class_to_button_process"), 10, 1);
    add_filter("gform_submit_button", array($this,"pbc_gf_add_class_to_button_front_end"), 10, 2);
    add_filter("gform_field_content", array($this,"bootstrap_styles_for_gravityforms_fields"), 10, 5);
    add_filter( 'gform_validation_message', array($this,'change_gf_validation_message'), 10, 2 );
  
    $userRegistration = new GFForm\GFUserRegistration();
  }


  function change_gf_validation_message( $message, $form ) {
      return "<div class='alert alert-danger' role='alert'>".$message."</div>";
  }
  //add_filter( 'gform_field_container', 'add_bootstrap_container_class', 10, 6 );
  function add_bootstrap_container_class( $field_container, $field, $form, $css_class, $style, $field_content ) {
    $id = $field->id;
    $field_id = is_admin() || empty( $form ) ? "field_{$id}" : 'field_' . $form['id'] . "_$id";
    return '<li id="' . $field_id . '" class="' . $css_class . ' form-group">{FIELD_CONTENT}</li>';
  }

  function pbc_gf_add_class_to_button_ui($form_settings, $form){
      $text_style_display = '';
      $form_settings["Form Button"]["button_class"] = '
      <tr id="form_button_text_setting" class="child_setting_row" style="' . $text_style_display . '">
              <th>
                  ' .
        pll__( 'Button Class', 'gravityforms' ) . ' ' .
        gform_tooltip( 'form_button_class', '', true ) .
        '
      </th>
      <td>
        <input type="text" id="form_button_text_class" name="form_button_text_class" class="fieldwidth-3" value="' . esc_attr( rgars( $form, 'button/class' ) ) . '" />
              </td>
          </tr>';
      return $form_settings;
  }

   function pbc_gf_add_class_to_button_process($updated_form){
    $updated_form['button']['class'] = rgpost( 'form_button_text_class' );
    return $updated_form;
  }

  function pbc_gf_add_class_to_button_front_end($button, $form){
      
       preg_match("/class='[\.a-zA-Z_ -]+'/", $button, $classes);
       $classes[0] = substr($classes[0], 0, -1);
       $classes[0] .= ' ';
       if(isset($form['button']['class'])) $classes[0] .= esc_attr($form['button']['class']);
       $classes[0] .= "'";
      $button_pieces = preg_split(
                "/class='[\.a-zA-Z_ -]+'/", 
                $button,
                -1,
                PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY
      );
      return $button_pieces[0] . $classes[0] . $button_pieces[1];
  }


  function bootstrap_styles_for_gravityforms_fields($content, $field, $value, $lead_id, $form_id){
    
      // Currently only applies to most common field types, but could be expanded.
    
      if($field["type"] != 'hidden' && $field["type"] != 'list' && $field["type"] != 'multiselect' && $field["type"] != 'checkbox' && $field["type"] != 'fileupload' && $field["type"] != 'date' && $field["type"] != 'html' && $field["type"] != 'address') {
          $content = str_replace('class=\'medium', 'class=\'form-control medium', $content);
      }
    
      if($field["type"] == 'name' || $field["type"] == 'address') {
          $content = str_replace('<input ', '<input class=\'form-control\' ', $content);
      }
    
      if($field["type"] == 'textarea') {
          $content = str_replace('class=\'textarea', 'class=\'form-control textarea', $content);
      }    
      if($field["type"] == 'password') {
          $content = str_replace('type=\'password', 'type=\'password\' class=\'form-control\'', $content);
      }
    
      if($field["type"] == 'checkbox') {
          $content = str_replace('li class=\'', 'li class=\'checkbox ', $content);
          $content = str_replace('<input ', '<input style=\'margin-left:1px;\' ', $content);
      }
    
      if($field["type"] == 'radio') {
          $content = str_replace('li class=\'', 'li class=\'radio ', $content);
          $content = str_replace('<input ', '<input style=\'margin-left:1px;\' ', $content);
      }
    
    return $content;
    
  } // End bootstrap_styles_for_gravityforms_fields()

}
