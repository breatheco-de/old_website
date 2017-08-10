<?php
use BreatheCode\WPTypes\PostType\WPCohort;
get_header('boxed'); 
$args = WPAS\Controller\WPASController::getViewData();
if(is_a($args, 'WP_Error')) echo WPAS\Controller\WPASController::printError($args); 
?>
        <div class="container title-container">
            <div class="row text-white">
                <div class="col-md-12">
                    <h1>
                        <?php echo $args['term']->name; ?>
                    </h1>
                    <h5><?php echo (isset($args['termParent']) and isset($args['termParent']->name)) ? $args['termParent']->name : ""; ?></h5>
                </div>
            </div>
        </div>

    </header>
    <main class="container main-content">
        <div class="row">
            <div class="col-sm-6">
                <div class="well">
                    <p>Status: <span class="label label-default"><?php echo (isset($args['termMeta'][WPCohort::META_COHORT_STAGE])) ? $args['termMeta'][WPCohort::META_COHORT_STAGE] : "Not set"; ?></span></p>
                    <div class="input-group">
                      <div class="input-group-addon">Slack</div>
                      <input type="text" class="form-control" id="exampleInputAmount" value="<?php echo $args['termMeta'][WPCohort::META_COHORT_SLACK]; ?>">
                    </div>
                </div>
                <div class="well">
                    <p>Mentors</p>
                    <ol>
                    <?php if(isset($args['teachers'])) foreach($args['teachers'] as $tea){ ?>
                      <li>
                        <?php echo get_user_meta($tea->data->ID,'first_name',true); ?> <?php echo get_user_meta($tea->data->ID,'last_name',true); ?>
                        <?php if($args['teacher_id']==$tea->data->ID){ ?> (Main) <?php } ?>
                      </li>
                    <?php } ?>
                    </ol>
                </div>
            </div>
            <div class="col-sm-6">
                <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($args['students'])) foreach($args['students'] as $std){ ?>
                    <tr>
                        <td>#<?php echo $std->data->ID; ?></td>
                        <td>
                            <a href="<?php echo get_permalink( get_page_by_path( 'student-profile' ) ); ?>?student=<?php echo $std->data->ID; ?>"><?php echo get_user_meta($std->data->ID,'first_name',true); ?> <?php echo get_user_meta($std->data->ID,'last_name',true); ?></a>
                        </td>
                        <td><?php echo $std->data->user_email; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
    </main>
    
    <?php include(locate_template(VIEWS_PATH.'_partials/modal-update_repls.php')); ?>
    <?php include(locate_template(VIEWS_PATH.'_partials/modal-get_attendancy.php')); ?>
    
    <ul id="material-menu" class="mfb-component--br mfb-zoomin" data-mfb-toggle="hover">
      <li class="mfb-component__wrap">
        <a href="#" class="mfb-component__button--main">
          <i class="mfb-component__main-icon--resting fa fa-bars"></i>
          <i class="mfb-component__main-icon--active fa fa-times"></i>
        </a>
        <ul class="mfb-component__list">
          <li>
            <a href="<?php echo get_permalink( get_page_by_path( 'review-assignments' ) ); ?>?teacher=<?php echo $args['teacher_id']; ?>&cohort=<?php echo $args['term']->name; ?>" data-mfb-label="Review Cohort Assignments" class="mfb-component__button--child">
              <i class="mfb-component__child-icon fa fa-file-code-o"></i>
            </a>
          </li>
          <li>
            <a data-mfb-label="Get Attendancy" class="mfb-component__button--child" data-target="#class_attendancy" data-toggle="modal">
              <i class="mfb-component__child-icon fa fa-list-alt"></i>
            </a>
          </li>
          <!--
          <li>
            <a href="https://github.com/nobitagit" data-mfb-label="Edit Cohort Info" class="mfb-component__button--child">
              <i class="mfb-component__child-icon fa fa-pencil"></i>
            </a>
          </li>
          -->
          <li>
            <a href="#" data-mfb-label="Edit Repls" class="mfb-component__button--child" data-target="#update_repls" data-toggle="modal">
              <i class="mfb-component__child-icon fa fa-code"></i>
            </a>
          </li>
        </ul>
      </li>
    </ul>
<?php get_footer(); ?>