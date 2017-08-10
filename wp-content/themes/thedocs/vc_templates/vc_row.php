<?php
$redux_demo = get_option('redux_demo');
$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = '';
extract(shortcode_atts(array(
    'el_class'        => '',
    'bg_image'        => '',
    //'bg_color'        => '',
    'bg_image_repeat' => '',
    //'font_color'      => '',
    'padding'         => '',
    'margin_bottom'   => '',
    'css' => '',
    'wrap_class'=>'',
    'ses_title'=>'',
    'ses_sub_title'=>'',
    'ses_id'=>'',
    'type_row' => '',
    'ses_image' => '',
), $atts));

wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ''. ( $this->settings('base')==='vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);
if($type_row == 'type2'){
    $output .= wpb_js_remove_wpautop($content);
    $output .= $this->endBlockComment('row');
}elseif($type_row == 'sample'){

      $output .='<h2 id="'.esc_attr($ses_id).'">'.esc_attr($ses_title).'</h2>
                    
                    <p>'.htmlspecialchars_decode($ses_sub_title).'</p>
                    <div class="row">';

    $output .= wpb_js_remove_wpautop($content);
    $output .=''.$this->endBlockComment('row');

$output .='</div><!-- End row -->';

}elseif($type_row == 'skin'){

      $output .='<h3>'.esc_attr($ses_title).'</h3>
            <p>'.htmlspecialchars_decode($ses_sub_title).'</p>
                    <div class="row">';

    $output .= wpb_js_remove_wpautop($content);
    $output .=''.$this->endBlockComment('row');

$output .='</div><!-- End row -->';


}elseif($type_row == 'transparent'){
    $images = wp_get_attachment_image_src($ses_image,'');

      $output .='<h3>'.esc_attr($ses_title).'</h3>
            <p>'.htmlspecialchars_decode($ses_sub_title).'</p>
            <br>
            <p><img class="img-responsive img-shadow" src="'.$images[0].'" alt="index"></p>
            <br>
                    <div class="row">';

    $output .= wpb_js_remove_wpautop($content);
    $output .=''.$this->endBlockComment('row');

$output .='</div><!-- End row -->';

}elseif($type_row == 'pagetitle'){
    $images = wp_get_attachment_image_src($ses_image,'');

      $output .='<header><h1>'.esc_attr($ses_title).'</h1>
            <p>'.htmlspecialchars_decode($ses_sub_title).'</p></header>
                    <div class="row">';

    $output .= wpb_js_remove_wpautop($content);
    $output .=''.$this->endBlockComment('row');

$output .='</div><!-- End row -->';

}elseif($type_row == 'snippet'){
      $output .='
                    <div class="code-snippet">';

    $output .= wpb_js_remove_wpautop($content);
    $output .=''.$this->endBlockComment('row');

$output .='</div><!-- End row -->';

}elseif($type_row == 'carousel'){
      $output .='
                    <div class="code-window">';

    $output .= wpb_js_remove_wpautop($content);
    $output .=''.$this->endBlockComment('row');

$output .='</div><!-- End row -->';

}else{
    $output .= wpb_js_remove_wpautop($content);
    $output .= $this->endBlockComment('row');

}
echo $output;

