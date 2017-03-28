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
      "assignment-status" => getStatus($status),
      "assignment-duedate" => $duedate,
      "assignment-permalink" => get_the_permalink($assignmentId),
      "project-id" => $projectId,
      "project-name" => get_the_title($projectId),
      "project-excerpt" => get_post_meta( $projectId, 'wpcf-project-excerpt',true)
      ));
  }

  return $assignments;
}

function getStatus($status)
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
                    <div class="col-sm-8">
                      <h5><?php echo $a["project-name"]; ?></h5>
                      <p><?php echo $a["project-excerpt"]; ?></p>
                    </div>
                    <div class="col-sm-2 assignment-bar">
                      <p class="text-center">
                        <i class="fa fa-calendar" aria-hidden="true"></i> Due: <?php echo $duedate; ?><br />
                        <?php echo $a["assignment-status"]; ?>
                      </p>
                    </div>
                    <div class="col-sm-2 assignment-bar">
                      <a href="<?php echo $a["assignment-permalink"]; ?>" class="btn btn-primary">View</a>
                    </div>
                  </div>
                </li>
        <?php } ?>
            </ul>
            <?php if(count($assignments)==0) echo "<h2>No assignments yet, get ready! ;)</h2>"; ?>
          </div>
      </div>
      <p>&nbsp;</p>
    </main>

<?php get_footer(); ?>