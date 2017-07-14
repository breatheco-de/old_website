<?php
get_header('boxed'); 
?>
    <div class="container">
        <h1>Test your knowledge!</h1>
        <?php if(isset($_GET['qslug'])){ ?>
            <iframe class="bcquiz" src="<?php echo ASSETS_URL; ?>quiz/app/?slug=<?php echo $_GET['qslug']; ?>" width="100%" height="600" frameBorder="0">Browser not compatible.</iframe>
        <?php } ?>
    </div>

<?php get_footer(); ?>