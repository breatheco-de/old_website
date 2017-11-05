import {BCMessaging} from '../breathecode/module/messaging';
import {JSDialog} from 'myclabs.jquery.confirm';
/**
*    Declaration of your module
*    @params modulename and undefined
**/
export default class bulkbadges{ 

    init(){
    	
    	let cohort = this.getParameterByName('cohort');
    	if(cohort) document.querySelector('#cohort-id').value = cohort;
    	document.querySelector('#cohort-id').addEventListener("change", e => {
    		if ('URLSearchParams' in window) {
			    var searchParams = new URLSearchParams(window.location.search);
			    searchParams.set("cohort", e.target.value);
			    window.location.search = searchParams.toString();
			}
    	});

    	document.querySelector('#badge-slug').addEventListener("change", e => {
    		document.querySelector('#givebadges').classList.remove('hidden');
    	});
    	
    	let students = document.querySelectorAll('.studentsToAssign li');
    	if(students && students.length>0) Array.from(students).forEach(stud => {
    		stud.addEventListener('click',e => {
    			let currentStudent = e.target;
    			if(currentStudent.classList.contains('selected')) currentStudent.classList.remove('selected');
    			else currentStudent.classList.add('selected');
    		});		
    	});
    	
		$("#givebadges").confirm({
		    text: "Are you sure you want to give the badges?",
		    title: "Confirmation required",
		    confirm: (button) => {
		        this.givebadges();
		    },
		    cancel: function(button) {
		        // nothing to do
		    },
		    confirmButton: "Yes I am",
		    cancelButton: "No",
		    post: true,
		    confirmButtonClass: "btn-danger",
		    cancelButtonClass: "btn-default",
		    dialogClass: "modal-dialog modal-lg" // Bootstrap classes for large modal
		});
    }
    
    givebadges(){
        var list = [];  
        var cohort = 0;
	    $(".studentsToAssign li.selected").each(function(){
            list.push($(this).data('id'));
        });
        
        let thedata = {
        	action: 'add_bulk_badges',
        	badge: $('#badge-slug').val(),
        	students: list,
        	points: $('#points').val()
        }
        console.log(thedata);
        
        $('.inside-content').hide();
        $('.loading').removeClass('hidden');
        this.sendForm(thedata);
    }
    
    getParameterByName(name, url) {
		if (!url) url = window.location.href;
		
		name = name.replace(/[\[\]]/g, "\\$&");
		
		var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
		results = regex.exec(url);
		
		if (!results) return null;
		if (!results[2]) return '';
		
		return decodeURIComponent(results[2].replace(/\+/g, " "));
	}
	
	sendForm(thedata){
	    
	 	$.ajax({
	 	    url: WPAS_APP.ajax_url,
	 	    method: 'post',
	 	    dataType: "json",
	 	    data: thedata, 
	 	    success: response => {
			    if(response){
			        if(response.code=='200')
			        {
			            $('.loading').html('Success! <a href="#" onClick="window.location.reload();">Click here to give more badges</a>');
			        }
			        else
			        {
			        	BCMessaging.notifyPending(BCMessaging.ERROR,response.msg);
			        }
			    }
	 	    }
	 	});
	 	
    }
    
}