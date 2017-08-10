<?php

print_r($_REQUEST); die();
get_template_part( VIEWS_PATH.'search/'.$_REQUEST['post_type']);