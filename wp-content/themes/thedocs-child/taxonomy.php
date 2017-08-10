<?php
$qo = get_queried_object();
//[slug] => infographics [term_group] => 0 [term_taxonomy_id] => 51 [taxonomy] => asset-type
get_template_part( VIEWS_PATH.'category/'.$qo->taxonomy);