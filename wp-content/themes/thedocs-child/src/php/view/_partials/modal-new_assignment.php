<div class="modal fade" id="modal_new-assignment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class='container'>
    	<h2>Create a new Assingment</h2>
    	<p class="modal-description">When submited, creating an assignment for each of the cohort students</p>
		<form class="form-create-assignment" role="form">
			<div style="display:none;" class="alert alert-danger" role="alert"></div>
            <div class="input-group">
                <span class="input-group-addon">Cohort Id:</span>
			    <input id="cohort" class="form-control" value="<?php echo $args['cohort_slug']; ?>" readonly="readonly" required="required" type="text">
            </div>
            <div class="input-group">
                <span class="input-group-addon">Delivery date:</span>
			    <input id="duedate" class="form-control" placeholder="Delivery date" required="required" type="date">
            </div>
			<select id="atemplate-select" class="form-control">
				<option selected="selected">Select a Template</option>
				<?php foreach($args['all-templates'] as $temp){ ?>
				<option value="<?php echo $temp->id; ?>"><?php echo $temp->title; ?></option>
				<?php } ?>
			</select>
			<button id="login" type="button" class="btn btn-lg btn-primary btn-block send-btn">Create Assigntment</button>
		</form>
    </div>
</div>