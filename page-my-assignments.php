<?php

/*
 * Template Name: My Assignments
 */
get_header('boxed'); 
$args = BCController::getViewData();
?>

<main class="container">
      <div class="row">

        <!-- Main content -->
        <article class="col-md-12 main-content" role="main">
          
          <?php if (have_posts()){ ?>
	
        		<?php while (have_posts()) : the_post()?>
        			<?php the_content(); ?>
        		<?php endwhile; ?>
      	
        	<?php }else {
        		echo 'Page Canvas For Page Builder'; 
        	}?>

          
        </article>
      </div>
		  <div class="row">
          <div class="col-xs-12">
            <ul class='step-text assignments'>
        <?php foreach ($args['assignments'] as $a) { 
          $duedate = date('jS \of F', $a->assignment->duedate);
          ?>
                <li>
                  <div class="row push-right">
                    <div class="col-xs-9 col-md-10">
                      <h5><?php echo $a->template->title; ?>
                        <small>
                          <?php if($a->status=="pending"){ ?>
                            <i class="fa fa-calendar" aria-hidden="true"></i><?php echo pll__( 'Due by' ); ?> <?php echo $duedate; ?>
                          <?php } else { ?>
                            <?php echo $args['getStatusTag']($a->status); ?>
                          <?php } ?>
                        </small>
                      </h5>
                    </div>
                    <div class="col-xs-3 col-md-2 assignment-bar">
                      <a href="<?php echo $args['getAssignmentPermalink']($a); ?>" class="btn btn-xs btn-primary"><?php echo pll__( 'View' ); ?></a>
                      <?php if($a->status!="done" and $a->status!="missed"){ ?>
                      <a data-assignment="<?php echo $a->id; ?>" href="<?php echo get_permalink( get_page_by_path( 'deliver-assignment' ) ); ?>?assignment=<?php echo $a->id; ?>&project=<?php echo urlencode($a->template->title); ?>" class="btn btn-xs btn-success deliver-assignment"><?php echo pll__( 'Deliver' ); ?></a>
                      <?php } ?>
                    </div>
                  </div>
                </li>
        <?php } ?>
            </ul>
            <?php if(count($args['assignments'])==0) echo "<h3>".pll__( 'No assignments yet, get ready!' )." ;)</h3>"; ?>
          </div>
      </div>
      <p>&nbsp;</p>
    </main>
<?php get_footer(); ?>