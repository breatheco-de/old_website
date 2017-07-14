<?php
use WPTypes\WPCohort as WPCohort;
function getStudentsByCohort($cohortId){
    $auxUsers = array();
    $users = get_objects_in_term( $cohortId, WPCohort::POST_TYPE );
    foreach($users as $u) 
    {
        array_push($auxUsers,get_user_by('id',$u));
    }
    return $auxUsers;
}

function printRoles($roles){
    $resultStr = '';
    for($i=0;$i<count($roles);$i++){
        $resultStr .= $roles[$i];
        if($i<count($roles)-1) $resultStr .=  ",";
    }
    return $resultStr;
}

$term = get_queried_object();
$termMeta = get_option( 'taxonomy_'.$term->term_id);
$teacher = get_userdata($termMeta[WPCohort::META_MAIN_TEACHER]);
$termParent = get_term($term->parent,WPCohort::POST_TYPE);
$students = getStudentsByCohort($term->term_id);
get_header('boxed'); 
?>
        <div class="container title-container">
            <div class="row text-white">
                <div class="col-md-12">
                    <h1>
                        <?php echo $term->name; ?>
                    </h1>
                    <h5><?php echo (isset($termParent) and isset($termParent->name)) ? $termParent->name : ""; ?></h5>
                </div>
            </div>
        </div>

    </header>
    <main class="container main-container">
        <div class="row">
            <div class="col-sm-6">
                <div class="well">
                    <p>Teacher: <?php echo (isset($teacher) and isset($teacher->display_name)) ? $teacher->display_name : 'Not assigned'; ?></p>
                    <p>Status: <span class="label label-default"><?php echo (isset($termMeta[WPCohort::META_COHORT_STAGE])) ? $termMeta[WPCohort::META_COHORT_STAGE] : "Not set"; ?></span></p>
                    <div class="input-group">
                      <div class="input-group-addon">Slack</div>
                      <input type="text" class="form-control" id="exampleInputAmount" value="<?php echo $termMeta[WPCohort::META_COHORT_SLACK]; ?>">
                    </div>
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
                    <?php foreach($students as $std){ ?>
                    <tr>
                        <td>#<?php echo $std->data->ID; ?></td>
                        <td>
                            <?php echo get_user_meta($std->data->ID,'first_name',true); ?> <?php echo get_user_meta($std->data->ID,'last_name',true); ?><br/>
                        </td>
                        <td><?php echo $std->data->user_email; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
    </main>
    
    <ul id="material-menu" class="mfb-component--br mfb-zoomin" data-mfb-toggle="hover">
      <li class="mfb-component__wrap">
        <a href="#" class="mfb-component__button--main">
          <i class="mfb-component__main-icon--resting fa fa-bars"></i>
          <i class="mfb-component__main-icon--active fa fa-times"></i>
        </a>
        <ul class="mfb-component__list">
          <li>
            <a href="<?php echo get_permalink( get_page_by_path( 'review-assignments' ) ); ?>?teacher=<?php echo $teacher->ID; ?>" data-mfb-label="Review Cohort Assignments" class="mfb-component__button--child">
              <i class="mfb-component__child-icon fa fa-file-code-o"></i>
            </a>
          </li>
          <li>
            <a href="https://github.com/nobitagit" data-mfb-label="Get Attendancy" class="mfb-component__button--child">
              <i class="mfb-component__child-icon fa fa-list-alt"></i>
            </a>
          </li>
          <li>
            <a href="https://github.com/nobitagit" data-mfb-label="Edit Cohort Info" class="mfb-component__button--child">
              <i class="mfb-component__child-icon fa fa-pencil"></i>
            </a>
          </li>
        </ul>
      </li>
    </ul>
<?php get_footer(); ?>