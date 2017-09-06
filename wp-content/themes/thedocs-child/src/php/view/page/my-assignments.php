<?php
/*
 * Template Name: My Assignments
 */
get_header('boxed'); 
$args = WPAS\Controller\WPASController::getViewData();
?>

<main class="container main-content">
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
        <?php if(isset($args['assignments'])) foreach ($args['assignments'] as $a) { 
          $duedate = date('jS \of F', $a->assignment->duedate);
          ?>
                <li>
                  <div class="row push-right">
                    <div class="col-xs-9 col-md-10">
                      <h5><?php echo $a->template->title; ?>
                        <small>
                          <?php if($a->status=="not-delivered"){ ?>
                            <i class="fa fa-calendar" aria-hidden="true"></i> <?php echo pll__( 'Due by' ); ?> <?php echo $duedate; ?>
                          <?php } else { ?>
                            <?php echo $args['getStatusTag']($a->status); ?>
                          <?php } ?>
                        </small>
                      </h5>
                    </div>
                    <div class="col-xs-3 col-md-2 assignment-bar">
                      <?php if(!in_array($a->status,['reviewed','delivered'])){ ?>
                      <a data-assignment="<?php echo $a->id; ?>" data-assignment-title="<?php echo $a->template->title; ?>" href="#" data-toggle="modal" data-target="#modal-deliver_assignment" class="btn btn-xs btn-success deliver-assignment"><?php echo pll__( 'Deliver' ); ?></a>
                      <?php } ?>
                      <a target="_blank" href="<?php echo $args['getAssignmentPermalink']($a); ?>" class="btn btn-xs btn-primary"><?php echo pll__( 'View' ); ?></a>
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
<?php include(locate_template(VIEWS_PATH.'_partials/modal-deliver_assignment.php')); ?>
<?php get_footer(); ?>