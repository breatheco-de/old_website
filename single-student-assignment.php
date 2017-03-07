<?php

get_header('asset'); 

if (have_posts()){
    the_post();

    $assignmentId = get_the_ID();
    $duedate = get_post_meta( $assignmentId, 'wpcf-assignment-due-date',true);

    $projectId = get_post_meta( $assignmentId, 'wpcf-project-assigned',true);
    $thumbnail = get_the_post_thumbnail( $projectId, 'post_thumbnail', array( 'class' => 'alignleft img-responsive' ) );
    $projectContent = get_post_field('post_content', $projectId);
    $projectTitle = get_the_title($projectId);
    $filesUrl = get_post_meta( $projectId, 'wpcf-project-files',true);
    $duration = get_post_meta( $projectId, 'wpcf-project-hour-duration',true);
    $dificulty = get_post_meta( $projectId, 'wpcf-project-difficulty',true);
?>
    <main class="container main-content">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="single-title"><?php echo $projectTitle; ?></h2>
        </div>
    </div>
    <div class="row">
        <!-- Main content -->
        <article class="col-md-8 col-sm-9" role="main">
            <div class="row">
                <div class="col-sm-12">
                    <?php echo do_shortcode($projectContent); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    
                </div>
            </div>
        </article>
<!-- Sidebar -->
        <aside class="col-md-4 col-sm-3">
            <div class="">
                <h4 id="duedate">
                    <i class="fa fa-calendar" aria-hidden="true"></i> Due:
                    <?php echo date('jS \of F', $duedate); ?>
                </h4> 
            </div>
            <table class="table table-striped table-changelog">
              <tbody>
                <tr>
                    <td>Technologies:</td>
                    <td>
                        <?php $technologies = wp_get_post_terms($projectId,'project-technology');
                        foreach ($technologies as $technology) { ?>
                            <a href="#" class="label label-default"><?php echo $technology->name; ?></a>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td>Difficulty</td>
                    <td>
                        <?php echo $dificulty; ?>
                    </td>
                </tr>
                <tr>
                    <td>Duration</td>
                    <td>
                        <?php echo $duration; ?> Hours
                    </td>
                </tr>
              </tbody>
            </table>
            <?php if($thumbnail and $thumbnail!='') { ?>
                <?php echo $thumbnail; ?>
            <?php } ?>
            <?php if($filesUrl and $filesUrl!=''){ ?>
            <div class="callout callout-info" role="alert">
                <h4>
                    <i class="fa fa-download"></i>
                    <a target="_parent" href="<?php echo $filesUrl; ?>">Download project files</a>
                </h4>
            </div>
            <?php } ?>
        </aside>
        <!-- END Sidebar -->
    </div>


</main>
<?php } ?>

<?php get_footer(); ?>