<div class="modal fade" id="modal-accept_assignment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class='container'>
    	<h2>Accept Assignment</h2>
    	<p class="modal-description">By clicking "accept" you will be giving the student the following points.</p>
		<form id='acceptassignment' class="form-create-assignment" role="form">
			<input id="assignment-id" class="form-control" value="" type="hidden">
			<div style="display:none;" class="alert alert-danger" role="alert"></div>
            <div class="input-group">
                <span class="input-group-addon">Assingment:</span>
			    <input id="assignment-title" class="form-control" value="" readonly="readonly" required="required" type="text">
            </div>
            <div class="input-group">
                <span class="input-group-addon">Student:</span>
			    <input id="student-name" class="form-control" readonly="readonly" required="required" type="text">
            </div>
            <h4>Choose earnings on each badge:</h4>
            <div class='project-earnings'></div>
			<button id="login" type="button" class="btn btn-lg btn-primary btn-block send-btn">Accept</button>
		</form>
    </div>
</div>