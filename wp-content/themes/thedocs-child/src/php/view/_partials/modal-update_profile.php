<div class="modal fade" id="modal-update_profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class='container'>
    	<h2>Update Profile Information</h2>
    	<p class="modal-description">Here you can update all your student information</p>
		<form class="form-create-assignment" role="form">
			<input id="assignment" type="hidden">
            <div class="input-group">
                <span class="input-group-addon">First Name:</span>
			    <input id="firstname" class="form-control" required="required" type="text" value="<?php echo $args['user']['first_name']; ?>">
            </div>
            <div class="input-group">
                <span class="input-group-addon">Last Name:</span>
			    <input id="lastname" class="form-control" required="required" type="text" value="<?php echo $args['user']['last_name']; ?>">
            </div>
            <div class="input-group">
                <span class="input-group-addon">Github username:</span>
			    <input id="github" class="form-control" required="required" type="text" value="<?php echo $args['user']['github']; ?>">
            </div>
            <div class="input-group">
                <span class="input-group-addon">Phone number:</span>
			    <input id="phonenumber" class="form-control" required="required" type="text" value="<?php echo $args['user']['phone']; ?>">
            </div>
            <div class="input-group">
                <span class="input-group-addon">Bio</span>
			    <input id="bio" class="form-control" placeholder="250 characters max" required="required" type="text" value="<?php echo $args['user']['description']; ?>">
            </div>
			<button id="login" type="button" class="btn btn-lg btn-primary btn-block send-btn">Update information</button>
		</form>
    </div>
</div>