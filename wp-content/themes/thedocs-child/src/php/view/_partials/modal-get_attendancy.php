<div class="modal fade" id="class_attendancy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class='container'>
    	<h2>Class Attendancy for <?php echo date("Y-m-d"); ?></h2>
			<div style="display:none;" class="alert alert-danger" role="alert"></div>
			<?php foreach($args['students'] as $s) { ?>
            <div class="input-group">
                <span class="input-group-addon">
                    <input class='attendants' type="checkbox" name="attendants[]" value="<?php echo $s->ID ?>">
                </span>
			    <input id="cohort" class="form-control" value="<?php echo $s->display_name; ?>" readonly="readonly" type="text">
            </div>
            <?php } ?>
			<button class="send-btn btn btn-lg btn-primary btn-block">Send Attendancy Report</button>
    </div>
</div>