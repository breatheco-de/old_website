<?php

if (is_user_logged_in())
{
	wp_redirect( get_permalink(get_page_by_path( 'my-courses' )) );
	exit;
}

get_header('boxed'); 
?>
<div class="container">

      <form class="form-signin" role="form">
        <h2 class="form-signin-heading">Please sign in</h2>
        <div style="display:none;" class="alert alert-danger" role="alert"></div>
        <input id="username" class="form-control" placeholder="Email address" required="required" autofocus="" type="email">
        <input id="password" class="form-control" placeholder="Password" required="required" type="password">
        <p><a href="#">Forgot your password?</a></p>
        <button id="login" class="btn btn-lg btn-primary btn-block">Sign in</button>
      </form>

</div>
<?php get_footer(); ?>