<?php

/*
 * Template Name: Teacher Dashboard
 */
get_header('boxed'); 
$args = WPAS\Controller\WPASController::getViewData();
?>
<main class="container">
	<h3>The following is a list of all your assignments</h3>
        <div id="filter-panel" class="collapse filter-panel">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-inline" role="form">
                        <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="pref-perpage">Rows per page:</label>
                            <select id="pref-perpage" class="form-control">
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option selected="selected" value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                                <option value="300">300</option>
                                <option value="400">400</option>
                                <option value="500">500</option>
                                <option value="1000">1000</option>
                            </select>                                
                        </div> <!-- form group [rows] -->
                        <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="pref-search">Search:</label>
                            <input type="text" class="form-control input-sm" id="pref-search">
                        </div><!-- form group [search] -->
                        <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="pref-orderby">Order by:</label>
                            <select id="pref-orderby" class="form-control">
                                <option>Descendent</option>
                            </select>                                
                        </div> <!-- form group [order by] --> 
                        <div class="form-group">    
                            <div class="checkbox" style="margin-left:10px; margin-right:10px;">
                                <label><input type="checkbox"> Remember parameters</label>
                            </div>
                            <button type="submit" class="btn btn-default filter-col">
                                <span class="glyphicon glyphicon-record"></span> Save Settings
                            </button>  
                        </div>
                    </form>
                </div>
            </div>
        </div>    
        <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#filter-panel">
            <span class="glyphicon glyphicon-cog"></span> Advanced Search
        </button>
	<ul class='step-text assignments'>
		<?php if(count($args['assignments'])==0) echo '<p>There are no assignments</p>'; ?>
		<?php foreach($args['assignments'] as $assignment){ ?>
                <li>
                  <div class="row push-right">
                    <div class="col-xs-9 col-md-10">
                      <h5><?php echo $assignment->title; ?>
                        <small>
                            <i class="fa fa-calendar" aria-hidden="true"></i><?php echo pll__( 'Due by' ); ?> Mario
                        </small>
                      </h5>
                    </div>
                    <div class="col-xs-3 col-md-2 assignment-bar">
                      <a data-assignment="12" href="<?php echo get_permalink( get_page_by_path( 'deliver-assignment' ) ); ?>?assignment=<?php echo 12; ?>&project=<?php echo 12; ?>" class="btn btn-xs btn-success deliver-assignment"><?php echo pll__( 'Deliver' ); ?></a>
                      <a href="12" class="btn btn-xs btn-primary"><?php echo pll__( 'View' ); ?></a>
                    </div>
                  </div>
                </li>
        <?php } ?>
	</ul>
</main>
<ul id="material-menu" class="mfb-component--br mfb-zoomin" data-mfb-toggle="hover">
  <li class="mfb-component__wrap">
    <a href="#" class="mfb-component__button--main">
      <i class="mfb-component__main-icon--resting fa fa-bars"></i>
      <i class="mfb-component__main-icon--active fa fa-times"></i>
    </a>
    <ul class="mfb-component__list">
      <li>
        <a id="new-assignment" data-toggle="modal" data-target="#myModal" href="#" data-mfb-label="Create new Assignment" class="mfb-component__button--child">
          <i class="mfb-component__child-icon fa fa-plus"></i>
        </a>
      </li>
    </ul>
  </li>
</ul>
<?php include(locate_template(VIEWS_PATH.'_partials/modal-newassignment.php')); ?>

<?php get_footer(); ?>