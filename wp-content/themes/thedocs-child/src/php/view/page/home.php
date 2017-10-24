<?php
get_header();
$args = WPAS\Controller\WPASController::getViewData();
?>

<?php if(is_a($args, 'WP_Error')){ ?>
    <div class="alert alert-danger fade in alert-dismissable text-center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
        <strong>Oooooppppsss!</strong> <?php echo implode(',',$args->get_error_messages()); ?>
    </div>
<?php } else { ?>
    <main class="container-fluid project-profile">
    <div class="row">
        <div class="col-12">
            <h1>Hello world</h1>
        </div>
    </div>
</main>
<?php } ?>
<?php get_footer(); ?>