<?php

/*
 * Template Name: My Assignments
 */
get_header('boxed'); 

function get_assignments()
{
  $assignments = array();
  $loop = new WP_Query(array(
      'post_type' => 'student-assignment',
      'meta_key' => 'wpcf-student-assigned',
      'meta_value' => get_current_user_id(),
      'orderby' => 'wpcf-assignment-due-date',
      'order' => 'ASC'
  ));
  
  while ( $loop->have_posts() ){ $loop->the_post();
    $assignmentId = get_the_ID();
    $projectId = get_post_meta( $assignmentId, 'wpcf-project-assigned',true);
    $status = get_post_meta( $assignmentId, 'wpcf-assignment-status',true);
    $duedate = get_post_meta( $assignmentId, 'wpcf-assignment-due-date',true);

    array_push($assignments,array(
      "assignment-id" => $assignmentId,
      "assignment-status" => $status,
      "assignment-duedate" => $duedate,
      "assignment-permalink" => get_the_permalink($assignmentId),
      "project-id" => $projectId,
      "project-name" => get_the_title($projectId),
      "project-excerpt" => get_post_meta( $projectId, 'wpcf-project-excerpt',true)
      ));
  }

  return $assignments;
}

function getStatusTag($status)
{
  switch($status)
  {
    case "done":
      return '<span class="label label-success">'.$status.'</span>';
      break;
    case "missed":
      return '<span class="label label-danger">'.$status.'</span>';
      break;
    case "due":
      return '<span class="label label-warning">'.$status.'</span>';
      break;
    default:
      return '<span class="label label-default">'.$status.'</span>';
      break;
  }
}


$assignments = get_assignments();
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
        <?php foreach ($assignments as $a) { 
          $duedate = date('jS \of F', $a["assignment-duedate"]);
          ?>
                <li>
                  <div class="row push-right">
                    <div class="col-xs-9 col-md-10">
                      <h5><?php echo $a["project-name"]; ?>
                        <small>
                          <?php if($a["assignment-status"]=="pending"){ ?>
                            <i class="fa fa-calendar" aria-hidden="true"></i><?php echo pll__( 'Due by' ); ?> <?php echo $duedate; ?>
                          <?php } else { ?>
                            <?php echo getStatusTag($a["assignment-status"]); ?>
                          <?php } ?>
                        </small>
                      </h5>
                      <p><?php echo $a["project-excerpt"]; ?></p>
                    </div>
                    <div class="col-xs-3 col-md-2 assignment-bar">
                      <a href="<?php echo $a["assignment-permalink"]; ?>" class="btn btn-xs btn-primary"><?php echo pll__( 'View' ); ?></a>
                      <?php if($a["assignment-status"]!="done" and $a["assignment-status"]!="missed"){ ?>
                      <a href="<?php echo get_permalink( get_page_by_path( 'deliver-assignment' ) ); ?>?assignment=<?php echo $a["assignment-id"]; ?>&project=<?php echo urlencode($a["project-name"]); ?>" class="btn btn-xs btn-success"><?php echo pll__( 'Deliver' ); ?></a>
                      <?php } ?>
                    </div>
                  </div>
                </li>
        <?php } ?>
            </ul>
            <?php if(count($assignments)==0) echo "<h3>".pll__( 'No assignments yet, get ready!' )." ;)</h3>"; ?>
          </div>
      </div>
      <p>&nbsp;</p>
    </main>

<?php get_footer(); ?>