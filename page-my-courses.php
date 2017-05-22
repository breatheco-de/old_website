<?php

/*
 * Template Name: Page My Courses
 * Description: A Page Template with a Page Builder design.
 */
get_header('boxed'); 

function get_courses()
{
  $auxTerms = array();
  
  $userId = get_current_user_id();
  $parentTerms = wp_get_object_terms( $userId, 'course' );
  foreach($parentTerms as $pTerm)
  {
    //array_push($auxTerms,$pTerm);
    $childrens = get_term_children( $pTerm->term_id, 'course' );
    //die(print_r($childrens));
    foreach($childrens as $cTerm){
      $cTerm = get_term_by('id', $cTerm, 'course');
      array_push($auxTerms,$cTerm);
    }
  }
	return $auxTerms;
}


$courses = get_courses();
$content = false;
if(have_posts()) { 
  the_post();
  $content = do_shortcode(get_the_content());
}
?>

<main class="container">
    <?php if($content){ ?>
      <div class="row">

        <!-- Main content -->
        <article class="col-md-12 main-content" role="main">
            <?php echo $content; ?>          
        </article>
      </div>
    <?php } ?>
		<div class="row">
			<?php foreach ($courses as $course) { ?>
              <div class="col-md-4 col-sm-6">
                <div class="promo small-icon left" style="height: 133px;">
                  <i class="fa fa-code"></i>
                  <h3><?php echo $course->name; ?></h3>
                  <p><?php echo $course->description; ?></p>
                  <a class="btn btn-primary btn-block" href="<?php echo esc_url( get_term_link( $course ) ); ?>"><?php echo pll__('Get inside'); ?></a>
                </div>
              </div>
			<?php } ?>
        </div>
        <p>&nbsp;</p>
    </main>

<?php get_footer(); ?>