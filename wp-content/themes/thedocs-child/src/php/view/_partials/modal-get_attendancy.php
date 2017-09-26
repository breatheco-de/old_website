<div class="modal fade" id="class_attendancy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class='container'>
    	<h2>Class Attendancy for <?php echo date("Y-m-d"); ?></h2>
			<div style="display:none;" class="alert alert-danger" role="alert"></div>
			<?php if(!isset($args['students']) || !is_array($args['students'])){ ?>
		       <p>There are no students</p>
			<?php } else { 
			    foreach($args['students'] as $s) { ?>
                <div class="input-group">
                    <span class="input-group-addon">
                        <input data-cohort="<?php echo $args['term']->term_id; ?>" class='attendants' type="checkbox" name="attendants[]" value="<?php echo $s->ID ?>">
                    </span>
    			    <input id="student<?php echo $s->ID ?>" class="form-control" name="names[]" value="<?php echo get_user_meta($s->ID,'first_name',true); ?> <?php echo get_user_meta($s->ID,'last_name',true); ?>" readonly="readonly" type="text">
                </div>
                <?php } ?>
			    <button class="send-btn btn btn-lg btn-primary btn-block">Send Attendancy Report</button>
            <?php } ?>
    </div>
</div>