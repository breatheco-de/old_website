<?php
get_header('boxed'); 
$args = wpas_get_view_data();

?>
    <div class="container main-content text-center">
        <h2>Apply badges to several students at once:</h2>
        <div class='loading hidden'>
            <?php echo @file_get_contents(get_stylesheet_directory_uri().'/assets/img/loading.svg'); ?>
        </div>
        <div class="inside-content">
            <div class="row">
                <div class="col-sm-3">
                    <select class="form-control" id="cohort-id">
                        <option>Select a cohort</option>
                        <?php foreach($args['cohorts'] as $c){ ?>
                        <option value="<?php echo $c->term_id; ?>"><?php echo $c->name; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-3">
                    <select class="form-control" id="badge-slug">
                        <option>Select a badge</option>
                        <?php foreach($args['badges'] as $b){ ?>
                        <option value="<?php echo $b->slug; ?>"><?php echo htmlentities($b->name); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-3">
                    <div class="tooltip">
                            <div class="tooltip-inner">
                                Tooltip!
                            </div>
                            <div class="tooltip-arrow"></div>
                        </div>
                    <div class="input-group">
                        
                        <span class="input-group-addon">+</span><input type="number" id="points" class="form-control" placeHolder="Points to all (optional)" />
                        
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <button id="givebadges" class='btn btn-success form-control hidden'>Apply</button>
                    </div>
                </div>        
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <ul class="studentsToAssign">
                        <?php if(count($args['students'])){ ?>
                            <?php foreach($args['students'] as $c){ ?>
                                <li data-id="<?php echo $c->data->ID; ?>" class="row">
                                    <div class="col-xs-9">
                                        <span><?php echo $c->data->display_name; ?></span>
                                    </div>
                                    <div class="col-xs-3 studentPoints">
                                        +<input type="text" placeholder="0" size="2"> points
                                    </div>
                                </li>
                            <?php } ?>
                        <?php } else {?>
                            <?php if(isset($_GET['cohort'])){ ?>
                            <li style="background: white;">The cohort contains no students.</li>
                            <?php } else { ?>
                            <li style="background: white;">Please select a cohort and a badge.</li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<ul id="material-menu" class="mfb-component--br mfb-zoomin" data-mfb-toggle="hover">
  <li class="mfb-component__wrap">
    <a href="#" class="mfb-component__button--main">
      <i class="mfb-component__main-icon--resting fa fa-bars"></i>
      <i class="mfb-component__main-icon--active fa fa-times"></i>
    </a>
    <ul class="mfb-component__list">
        <!--
      <li>
        <a id="update-settings" data-toggle="modal" data-target="#modal-update_settings" href="#" data-mfb-label="Your settings" class="mfb-component__button--child">
          <i class="mfb-component__child-icon fa fa-cog"></i>
        </a>
      </li>
      -->
      <li>
        <a id="update-profile" data-toggle="modal" data-target="#modal-update_profile" href="#" data-mfb-label="Update profile info" class="mfb-component__button--child">
          <i class="mfb-component__child-icon fa fa-pencil"></i>
        </a>
      </li>
    </ul>
  </li>
</ul>
<?php include(locate_template(VIEWS_PATH.'_partials/modal-update_profile.php')); ?>
<?php include(locate_template(VIEWS_PATH.'_partials/modal-update_settings.php')); ?>
<?php get_footer(); ?>