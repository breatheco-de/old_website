<?php
use WPTypes\WPCohort as WPCohort;
function getStudentsByCohort($cohortId){
    $auxUsers = array();
    $users = get_objects_in_term( $cohortId, 'user_cohort' );
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
$termParent = get_term($term->parent,'user_cohort');
$students = getStudentsByCohort($term->term_id);
get_header('boxed'); 

?>
      <!-- Banner -->
      <div class="banner">
        <div class="container">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li><a href="<?php echo get_permalink( get_page_by_path( 'teacher-cohorts' ) ) ?>">Cohorts</a></li>
              <li class="active"><?php echo $term->name; ?></li>
            </ol>
            <div class="row text-white">
                <div class="col-md-8">
                    <h1><?php echo $term->name; ?></h1>
                    <h5><?php echo (isset($termParent) and isset($termParent->name)) ? $termParent->name : ""; ?></h5>
                </div>
                <div class="col-md-4 class-information">
                    <div class="well">
                        <p>Teacher: <?php echo (isset($teacher) and isset($teacher->display_name)) ? $teacher->display_name : 'Not assigned'; ?></p>
                        <p>
                          Stage: <span class="label label-default"><?php echo (isset($termMeta[WPCohort::META_COHORT_STAGE])) ? $termMeta[WPCohort::META_COHORT_STAGE] : "Not set"; ?></span>
                        </p>
                        <div class="input-group">
                          <div class="input-group-addon">Slack</div>
                          <input type="text" class="form-control" id="exampleInputAmount" value="<?php echo $termMeta[WPCohort::META_COHORT_SLACK]; ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <!-- END Banner -->

    </header>
    <div class="container-fluid">
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Role</th>
                        <th>Nickname</th>
                        <th>Email</th>
                        <th>Github</th>
                        <th>Phone</th>
                        <th>Registration Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($students as $std){ ?>
                    <tr>
                        <td>#<?php echo $std->data->ID; ?></td>
                        <td><?php echo printRoles($std->roles); ?></td>
                        <td><?php echo $std->data->display_name; ?></td>
                        <td><?php echo $std->data->user_email; ?></td>
                        <td><?php echo get_user_meta( $std->data->ID, 'github', true ); ?></td>
                        <td><?php echo get_user_meta( $std->data->ID, 'phone', true ); ?></td>
                        <td><?php echo $std->data->user_registered; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

<?php get_footer(); ?>