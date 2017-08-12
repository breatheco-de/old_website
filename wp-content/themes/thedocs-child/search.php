<?php

$result = file_exists(get_template_directory().'-child/src/php/view/search/'.$_REQUEST['post_type'].'.php');
if($result) get_template_part( VIEWS_PATH.'search/'.$_REQUEST['post_type']);
else{
    echo 'Search template not found';
}