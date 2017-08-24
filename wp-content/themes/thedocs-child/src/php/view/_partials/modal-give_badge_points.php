<div class="modal fade" id="modal-give_badge_points" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class='container'>
    	<h2>Give Badge Points</h2>
    	<p class="modal-description">Give any points on any badge to this student</p>
		<form class="form-create-assignment" role="form">
			<input type="hidden" id="student-id" name="student" value="<?php echo $args['user']['id']; ?>">
			<div style="display:none;" class="alert alert-danger" role="alert"></div>
			<select id="badges" class="form-control">
				<option value="0">Select a badge</option>
			</select>
			<div class="second-part hide">
				<div class="row badge-info">
					<div class="col-xs-6 col-sm-4">
	                    <div class="single-badge">
	                        <div style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/badge-border/64/10.png')" class="badg-img-container p-10">
	                            <img id="badge-image" src="<?php echo BREATHECODE_API_HOST; ?>public/img/badge/rand/chevron-20.png" alt="" class="badg-img" />
	                        </div>
	                        <p id="badge-title" class='badge-name'>Loading Badge...</p>
	                    </div>
					</div>
					<div id="badge-description" class="badge-description" class="col-xs-6 col-sm-8">
						<p>ajnsdja sdjn asdjhlf asjldf sjd fljsd fjksfd slfdjb fjsaz fbljs fljsa fdljsb fvbe rgtj retv rjlhd ver tvjrt vljrhetvjh</p>
					</div>
				</div>
				<h4 class="text-center">How many points you want to give?</h4>
				<input type="number" id="points-given" name="points" class="form-control" min="0" max="10" placeholder="0">
			</div>
			<button id="login" type="button" class="btn btn-lg btn-primary btn-block send-btn">Give Points</button>
		</form>
    </div>
</div>