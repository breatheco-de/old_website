<div class="modal fade" id="update_repls" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class='container'>
    	<h2>Cohort Replit Excercises</h2>
		<form class="form-create-assignment" role="form">
			<div style="display:none;" class="alert alert-danger" role="alert"></div>
			<?php foreach($args['repls'] as $key => $val) { ?>
            <div class="input-group">
                <span class="input-group-addon"><?php echo $key; ?></span>
			    <input id="cohort" class="form-control" value="<?php echo $val; ?>" required="required" type="text">
            </div>
            <?php } ?>
			<button id="login" class="btn btn-lg btn-primary btn-block">Update Cohort Replit Classes</button>
		</form>
    </div>
</div>