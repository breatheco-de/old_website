<div class="modal fade" id="class_attendancy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class='container'>
    	<h2>Class Attendancy for <?php echo date("Y-m-d"); ?></h2>
		<form class="form-create-assignment" role="form">
			<div style="display:none;" class="alert alert-danger" role="alert"></div>
			<?php foreach($args['students'] as $s) { ?>
            <div class="input-group">
                <span class="input-group-addon">
                    <input type="checkbox" name="attendants[]" value="<?php $s->ID ?>">
                </span>
			    <input id="cohort" class="form-control" value="<?php echo $s->display_name; ?>" readonly="readonly" type="text">
            </div>
            <?php } ?>
			<button id="login" class="btn btn-lg btn-primary btn-block">Send Attendancy Report</button>
		</form>
    </div>
</div>