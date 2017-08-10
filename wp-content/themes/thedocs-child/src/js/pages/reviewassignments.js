import {BCMessaging} from '../breathecode/module/messaging';
/**
*    Declaration of your module
*    @params modulename and undefined
**/
export default class ReviewAssignments{  
    
    init(){
    	
    	document.querySelector('#modal_new-assignment .send-btn').addEventListener("click", btn => {
            let cohortId = $('#cohort').val();
            let templateId = $('#atemplate-select').val();
            let duedate = $('#duedate').val();
            this.createAsignment(cohortId,duedate,templateId);
    	});
    	
    	let acceptButtons = document.querySelector('.btn-success');
    	if(acceptButtons) acceptButtons.addEventListener('click',e =>{
			var thedata = {
			    action: 'get_assignment_earnings',
				slug: e.target.getAttribute('data-slug')
			};
			
            document.querySelector('#assignment-id').value = e.target.getAttribute('data-assignment');
            document.querySelector('#student-name').value = e.target.getAttribute('data-student');
    		
    		$.ajax({
    			url: WPAS_APP.ajax_url,
    			data: thedata,
    			success: response => {
    				if(response.code==500)
    				{
    					BCMessaging.notify(BCMessaging.ERROR,response.msg);
    				}
    				else{
    					let project = response.data;
    					let content = this.printProjectEarnings(project);
    					document.querySelector('.project-earnings').innerHTML = content;
            			document.querySelector('#assignment-title').value = project.title;
    				}
    			}
    		});
    	})
    	
    	document.querySelector('#modal-accept_assignment .send-btn').addEventListener("click", btn => {
            
            //let inputs = document.forms.acceptassignment;
            //var myControls = inputs.elements['badge[]'];
            let assignment = document.querySelector("#assignment-id").value;
            let inputs = document.querySelectorAll("input[name*='badge']");
            let badges = {};
            inputs.forEach(input => {
            	badges[input.getAttribute('data-key')] = input.value;
            })
            
            this.acceptAsignment(badges,assignment);
    	});
    	
    }
    
    send(assignmentId){
	    
		var thedata = {
		    action: 'deliver_project',
			assignment: assignmentId
		};
		// the_ajax_script.ajaxurl is a variable that will contain the url to the ajax processing file
	 	$.ajax({
	 	    url: WPAS_APP.ajax_url,
	 	    method: 'post',
	 	    dataType: "json",
	 	    data: thedata, 
	 	    success: function(response) {
			    if(response){
			        if(response.code=='200') window.location.reload();
			        else BCMessaging.notify(BCMessaging.ERROR,response.msg);
			    } else BCMessaging.notify(BCMessaging.ERROR,"The was an unexpected error");
	 	    }
	 	});
	 	
	 	return false;
    }
    
    createAsignment(cohortId,duedate,templateId){
	    
		var thedata = {
		    action: 'create_new_assignment',
			cohort_id: cohortId,
			duedate: duedate,
			template_id: templateId
		};
		// the_ajax_script.ajaxurl is a variable that will contain the url to the ajax processing file
	 	$.ajax({
	 	    url: WPAS_APP.ajax_url,
	 	    method: 'post',
	 	    dataType: "json",
	 	    data: thedata, 
	 	    success: function(response) {
			    if(response){
			        if(response.code=='200')  window.location.reload();
			        else BCMessaging.notify(BCMessaging.ERROR,response.msg);
			    }else BCMessaging.notify(BCMessaging.ERROR,"The was an unexpected error");
	 	    }
	 	});
	 	
	 	return false;
    }
    
    acceptAsignment(badges,assignmentId){
	    
		var thedata = {
		    action: 'accept_assignment',
			assignment_id: assignmentId,
			points: badges
		};
		// the_ajax_script.ajaxurl is a variable that will contain the url to the ajax processing file
	 	$.ajax({
	 	    url: WPAS_APP.ajax_url,
	 	    method: 'post',
	 	    dataType: "json",
	 	    data: thedata, 
	 	    success: function(response) {
	 	    	console.log(response);
			    if(response){
			        if(response.code=='200') window.location.reload();
			        else BCMessaging.notify(BCMessaging.ERROR,response.msg);
			    } else BCMessaging.notify(BCMessaging.ERROR,"The was an unexpected error");
	 	    }
	 	});
	 	
	 	return false;
    }
    
    printProjectEarnings(project){
    	let content = '';
    	project.talents.forEach(talent => {
    		content += `<div class="input-group">
				            <span class="input-group-addon">${talent.badge}</span>
						    <input max='${talent.points}' min='0' data-key="${talent.badge}" class="form-control talent-input" required="required" type="number" name='badge[]' value='${talent.points}'>
				        </div>`;
    	});
    	return content;
    }
    
}