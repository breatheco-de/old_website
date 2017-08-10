

<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
    return;
?>
      <div id="comments">

        <header><h6><?php comments_number('0','1','%'); ?> Comments</h6></header>
            <ul id="list-comments">
                  <?php if ( have_comments() ) : ?>
                 <?php wp_list_comments('callback=thedocs_theme_comment'); ?>
                  <?php endif; ?> 
            </ul>

            <div class="text-center">
              <ul class="pagination">
                <li>
                  <?php //Create pagination links for the comments on the current post, with single arrow heads for previous/next
                  paginate_comments_links( array('prev_text' => '<i class="fa fa-angle-left"></i>', 'next_text' => '<i class="fa fa-angle-right"></i>'));  ?>
                </li>
              </ul>
            </div>

            <div class="comment-form">
                <?php
                if ( is_singular() ) wp_enqueue_script( "comment-reply" );
                    $aria_req = ( $req ? " aria-required='true'" : '' );
                    $comment_args = array(
                            'id_form' => 'commentform',                                
                            'title_reply'=> 'Leave a Reply',
                            'fields' => apply_filters( 'comment_form_default_fields', array(
                                'author' => '
                                           <input class="form-control" type="text" name="author" placeholder="Name" value="" id="author">
                                            ',
                                'email' => '<input class="form-control" type="text" name="email" placeholder="Email" value="" id="email">
                                            ', 
                                'site' =>'<input class="form-control" type="text" name="url" placeholder="Site" value="" id="url">',    
                                                                                                       
                            ) ),   
                            'comment_field' => ' <textarea class="form-control" id="comment" name="comment" rows="5" placeholder="Message"'.$aria_req.'></textarea>
                                                ',                    
                             
                             'label_submit' => 'Post Comment',

                             'comment_notes_before' => '',
                             'comment_notes_after' => '',               
                    )
                ?>
                <?php comment_form($comment_args); ?>
              </div>
              
</div>

