<?php
/*
 * Template Name Posts: Project Page
 * Description: A Page Template with a Page Builder design.
 */
get_template_part(VIEWS_PATH.'header/asset'); 
$args = WPAS\Controller\WPASController::getViewData();
?>
    <main class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="single-title"><?php echo $args['post']->post_title; ?></h2>
        </div>
    </div>
    <div class="row">
        <!-- Main content -->
        <article class="col-md-9 col-sm-9" role="main">
            <div class="row">
                <div class="col-sm-12">
                    <?php echo $args['post']->post_content; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    
                </div>
            </div>
        </article>

        <!-- END Main content -->
        <!-- Sidebar -->
        <aside class="col-md-3 col-sm-3">
            <?php if($args['assignment']){ ?>
            <div class="">
                <h4 id="duedate">
                    <i class="fa fa-calendar" aria-hidden="true"></i> <?php echo pll__( 'Due' ); ?>:
                    <?php echo date('jS \of F', $duedate); ?>
                </h4> 
            </div>
            <?php } ?>
            <table class="table table-striped table-changelog">
              <tbody>
                <tr>
                    <td><?php echo pll__( 'Technologies' ); ?>:</td>
                    <td>
                        <?php foreach ($args['technologies'] as $technology) { ?>
                            <a href="<?php echo get_term_link($technology); ?>" class="label label-default"><?php echo $technology->name; ?></a>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo pll__( 'Difficulty' ); ?></td>
                    <td>
                        <?php echo $args['dificulty']; ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo pll__( 'Duration' ); ?></td>
                    <td>
                        <?php echo $args['duration']; ?> <?php echo pll__( 'Hours' ); ?>
                    </td>
                </tr>
              </tbody>
            </table>
            <?php if($args['thumbnail'] and $args['thumbnail']!='') { ?>
                <?php echo $args['thumbnail']; ?>
            <?php } ?>
            <?php if($args['filesUrl'] and $args['filesUrl']!=''){ ?>
            <div class="callout callout-info" role="alert">
                <h4>
                    <i class="fa fa-download"></i>
                    <a target="_parent" href="<?php echo $args['filesUrl']; ?>"><?php echo pll__( 'Download project files' ); ?></a>
                </h4>
            </div>
            <?php } ?>
        </aside>
        <!-- END Sidebar -->
    </div>


</main>
<?php get_footer(); ?>