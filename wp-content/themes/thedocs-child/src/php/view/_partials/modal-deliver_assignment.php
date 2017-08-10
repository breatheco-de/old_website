<div class="modal fade" id="modal-deliver_assignment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class='container'>
    	<h2>Deliver project assignment</h2>
    	<p class="modal-description">When submited, you will be sending your solution to your teacher</p>
		<form class="form-create-assignment" role="form">
			<input id="assignment" type="hidden">
			<div style="display:none;" class="alert alert-danger" role="alert"></div>
            <div class="input-group">
                <span class="input-group-addon">Assignment:</span>
			    <input id="assignment-title" class="form-control" readonly="readonly" required="required" type="text">
            </div>
            <div class="input-group">
                <span class="input-group-addon">Github URL:</span>
			    <input id="github" class="form-control" placeholder="http://" required="required" type="text">
            </div>
			<button id="login" type="button" class="btn btn-lg btn-primary btn-block send-btn">Deliver Assignment</button>
		</form>
    </div>
</div>