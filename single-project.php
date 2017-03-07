<?php
/*
 * Template Name Posts: Project Page
 * Description: A Page Template with a Page Builder design.
 */

get_header('asset'); 

if (have_posts()){
    the_post();

    $postId = get_the_ID();
    $course = null;
    if(is_single())
    {
        $postId = get_the_ID();
        $terms = wp_get_post_terms($postId,'course');

        if(count($terms)!=1) die('This project needs to be asigned to a course.');
        else $course = $terms[0];
    } 
    else $course = get_queried_object();
    $thumbnail = get_the_post_thumbnail( $postId, 'post_thumbnail', array( 'class' => 'alignleft img-responsive' ) );
    $filesUrl = get_post_meta( $postId, 'wpcf-project-files',true);
    $duration = get_post_meta( $postId, 'wpcf-project-hour-duration',true);
    $dificulty = get_post_meta( $postId, 'wpcf-project-difficulty',true);
?>
    <main class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="single-title"><?php echo the_title(); ?></h2>
        </div>
    </div>
    <div class="row">
        <!-- Main content -->
        <article class="col-md-9 col-sm-9" role="main">
            <div class="row">
                <div class="col-sm-12">
                    <?php the_content(); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    
                </div>
            </div>
        </article>

        <!-- END Main content -->
        <!-- Sidebar -->
        <aside class="col-md-3 col-sm-3 sidebar">
            <table class="table table-striped table-changelog">
              <tbody>
                <tr>
                    <td>Technologies:</td>
                    <td>
                        <?php $technologies = wp_get_post_terms($postId,'project-technology');
                        foreach ($technologies as $technology) { ?>
                            <a href="<?php echo get_term_link($technology); ?>" class="label label-default"><?php echo $technology->name; ?></a>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td>Dificulty</td>
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