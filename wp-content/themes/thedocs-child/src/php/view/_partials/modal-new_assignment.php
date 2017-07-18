<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class='container'>
    	<h2>Create a new Assingment</h2>
		<form class="form-create-assignment" role="form">
			<div style="display:none;" class="alert alert-danger" role="alert"></div>
            <div class="input-group">
                <span class="input-group-addon">Cohort Id:</span>
			    <input id="cohort" class="form-control" readonly="readonly" required="required" type="number">
            </div>
            <div class="input-group">
                <span class="input-group-addon">Delivery date:</span>
			    <input id="duedate" class="form-control" placeholder="Delivery date" required="required" type="date">
            </div>
			<select id="template" class="form-control">
				<option selected="selected">Select a Template</option>
			</select>
			<button id="login" class="btn btn-lg btn-primary btn-block">Create Assigntment</button>
		</form>
    </div>
</div>