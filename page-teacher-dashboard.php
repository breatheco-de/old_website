<?php

/*
 * Template Name: Teacher Dashboard
 */
get_header('boxed'); 

function get_cohorts()
{
	$terms = get_terms( array(
	    'taxonomy' => 'user_cohort',
	    'meta_query' => array(
			'relation' => 'AND', // Optional, defaults to "AND"
			array(
				'key'     => 'cohort-main-teacher',
				'value'   => get_current_user_id(),
				'compare' => '='
			),
			array(
				'key'     => 'cohort-stage',
				'value'   => array('on-prework','post-prework','final-project'),
				'compare' => 'IN'
			)
    	)
	));

	return $terms;
}


$cohorts = get_cohorts();
?>

<main class="container">
	<?php foreach ($cohorts as $c) { ?>
		<h3><?php echo $c->name; ?>,</h3>
  	<?php } ?>
</main>

<?php get_footer(); ?>