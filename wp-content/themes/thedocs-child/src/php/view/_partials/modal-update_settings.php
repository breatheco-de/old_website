<div class="modal fade" id="modal-update_settings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class='container'>
		<form class="form-update_settings" role="form">
        	<h2>Update Your Settings</h2>
        	<div class="row">
        	    <div class="col-sm-6">
        	        <h5>Notifications your receive</h5>
        	        <ul>
        	            <li><input class="settings" type="checkbox" name="notification-new-assignments" <?php if($args["settings"]["notification-new-assignments"]==="true") echo 'checked="checked"'; ?>/> New assignments</li>
        	            <li><input class="settings" type="checkbox" name="notification-new-points" <?php if($args["settings"]["notification-new-points"]==="true") echo 'checked="checked"'; ?>/> New points earned</li>
        	        </ul>
        	    </div>
        	    <div class="col-sm-6"></div>
        	</div>
			<button type="button" class="btn btn-lg btn-primary btn-block send-btn">Update Settings</button>
		</form>
    </div>
</div>