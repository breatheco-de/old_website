<div class="modal fade" id="modal-reject_assignment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class='container'>
    	<h2>Reject Assignment</h2>
    	<p class="modal-description">By clicking "reject" the assigment will be marked as rejected and the student will be notified of the reject reason.</p>
		<form id='rejectassigment' class="form-reject-assignment" role="form">
			<input id="assignment-id" class="form-control" value="" type="hidden">
			<div style="display:none;" class="alert alert-danger" role="alert"></div>
            <div class="input-group">
                <span class="input-group-addon">Reject Reason:</span>
                <textarea id="reject_reason" class="form-control" rows="5" maxlength="500" required></textarea>
            </div>
			<button id="login" type="button" class="btn btn-lg btn-primary btn-block send-btn hidden">Reject</button>
		</form>
    </div>
</div>