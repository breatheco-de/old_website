<?php

if (is_user_logged_in())
{
	wp_redirect( get_permalink(get_page_by_path( 'my-courses' )) );
	exit;
}

get_header('boxed'); 
?>
    <div class="container">
        <input type="text" id="username" name='username'>
        <input type="password" id="password" name='password'>
        <button id="login">Login</button>
    </div>

<script type="text/javascript">
jQuery(document).ready( function($) {
	$("#login").click( function() {
		var thedata = {
		    action: 'custom_login',
			username: $("#username").val(),
			password: $("#password").val()
		};
		// the_ajax_script.ajaxurl is a variable that will contain the url to the ajax processing file
	 	$.ajax({
	 	    url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
	 	    method: 'post',
	 	    dataType: "json",
	 	    data: thedata, 
	 	    success: function(response) {
			    if(response){
			        if(response.code=='200')
			        {
			            window.location.href = response.data;
			        }
			        else
			        {
			            alert(response.msg);
			        }
			    }
	 	    }
	 	});
	 	
	 	return false;
	});
});
</script>
<?php get_footer(); ?>