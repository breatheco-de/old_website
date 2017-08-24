<div class="modal fade" id="modal-enable_quiz" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class='container'>
    	<h2>Re-enable a quiz for a student</h2>
    	<p class="modal-description">If a particular student gets blocked from a quiz, you can re-enable his access to it.</p>
		<form class="form-create-assignment" role="form">
			<input type="hidden" id="student-id" name="student" value="<?php echo $args['user']['id']; ?>">
			<div style="display:none;" class="alert alert-danger" role="alert"></div>
			<select id="quiz-select" class="form-control">
				<option selected="selected">Select a quiz</option>
				<?php foreach($args['blocked-quizzes'] as $q){ ?>
				<option value="<?php echo $q; ?>"><?php echo $q; ?></option>
				<?php } ?>
			</select>
			<button id="login" type="button" class="btn btn-lg btn-primary btn-block send-btn">Enable</button>
		</form>
    </div>
</div>