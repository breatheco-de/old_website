import {BCMessaging} from '../breathecode/module/messaging';
/**
*    Declaration of your module
*    @params modulename and undefined
**/
export default class projects{
    
    constructor(){
        //any properties here using this.propertyName
        this.projects = [];
        this.getProjects();
    }
    
    init(){
        
            
        
    }
    
    getProjects(){
	    
		var thedata = {
		    action: 'get_projects'
		};
		// the_ajax_script.ajaxurl is a variable that will contain the url to the ajax processing file
	 	$.ajax({
	 	    url: WPAS_APP.ajax_url,
	 	    method: 'post',
	 	    dataType: "json",
	 	    data: thedata, 
	 	    success: response => {
			    if(response){
			        if(response.code=='200')
			        {
			            this.renderProjects(response.data);
			        }
			        else
			        {
			        	BCMessaging.notify(BCMessaging.ERROR,response.msg);
			        }
			    }
	 	    }
	 	});
	 	
    }
    
    renderProjects(projects){

        var list = document.querySelector('.projects ul');
        list.innerHTML = "";
        for(var i = 0; i<projects.length; i++){
            list.innerHTML += this.renderSingleProject(projects[i]);
        }
    }
    
    renderSingleProject(project)
    {
        return `<li class="single-project">
            <div class="row push-right">
                <div class="col-xs-9 col-md-10">
                    <h5>${project.title}</h5>
                    <p>${project.excerpt}</p>
                    <strong>Takes ${project.duration} hours, focused in ${this.getLabels(project.technologies)}</strong>
                </div>
                <div class="col-xs-3 col-md-2 assignment-bar">
                    <a href="/project?slug=${project.project_slug}" class="btn btn-primary">view</a>
                </div>
            </div>
        </li>`;
    }
    
    getLabels(labelString){
        let labels = labelString.split(',');
        return labels.map(label => `<span class="label label-default">${label}</span>`).join(' ');
    }
    
}