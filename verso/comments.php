<?php  
/**
 * The template for displaying comments
 *
 */
 
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
	
?>


<?php if ( have_comments() ) : ?>

 <div class="h-20"></div>
 <hr>

<div class="comment-wrap comments">	
	<h6 id="comments"><?php comments_number(esc_html__('No Comments','santos'), esc_html__('One Comment', 'santos'), esc_html__('% Comments', 'santos') );?></h6>
	
	<hr>
	<div class="h-20"></div>
	
	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
	

	<ul class="comment-list ">
		<?php wp_list_comments(array('avatar_size' => 60, 'callback' => 'santos_comment')); ?>
	</ul>
</div>
	
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		

	<?php endif; ?>
<?php endif; ?>

<?php if ( comments_open() ) : 

$required_text = null;

$args = array(
  'id_form'           => 'commentform',
  'id_submit'         => 'submit',
  'title_reply'       => esc_html__( 'Leave Comment', 'santos' ),
  'title_reply_to'    => esc_html__( 'Leave a Reply to %s', 'santos' ),
  'cancel_reply_link' => esc_html__( 'Cancel Reply', 'santos' ),
  'label_submit'      => esc_html__( 'Submit', 'santos' ),

  'comment_field' =>  '<div class="row"><div class="col-md-12"><div class="textarea-contact"><textarea id="comment" class="mat-input" name="comment" required="required" cols="45" rows="5" aria-required="true"></textarea><span>' . esc_html__( 'Comment ', 'santos' ) .' *</span></div></div></div>',

   'must_log_in' => '<p class="must-log-in">' .
  sprintf( wp_kses( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'santos' )  , array('a' => array('href' => array() ) ) ) ,
      wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
    ) . '</p>',

  'logged_in_as' => '<p class="logged-in-as">' .
  sprintf( wp_kses( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'santos' ) , array('a' => array('href' => array() ) ) ),
      esc_url( admin_url( 'profile.php' ) ),
      $user_identity,
      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
    ) . '</p>',

  'comment_notes_before' => '',

  'comment_notes_after' => '',

  'fields' => apply_filters( 'comment_form_default_fields', array(

    'author' =>
      '<hr><div class="h-30"></div><div class="row"><div class="col-md-4"><div class="input-contact"><input id="author" class="mat-input" name="author" type="text" required="required" aria-required="true"  value="' . esc_attr( $commenter['comment_author'] ) .
      '" size="30" /><span>' . esc_html__( 'Your Name', 'santos' ) .' *</span></div></div>',

    'email' =>
      '<div class="col-md-4"><div class="input-contact"><input id="email" name="email" class="mat-input" type="text" required="required" aria-required="true"  value="' . esc_attr(  $commenter['comment_author_email'] ) .
      '" size="30" /><span>' . esc_html__( 'Your Email', 'santos' ) .' *</span></div></div>',

    'url' =>
      '<div class="col-md-4"><div class="input-contact"><input id="url" name="url" class="mat-input" type="text"  value="' . esc_attr( $commenter['comment_author_url'] ) .
      '" size="30" /><span>' . esc_html__( 'Your Website', 'santos' ) .'</span></div></div></div>'
    )
  ),
);

comment_form($args);



endif; ?>


