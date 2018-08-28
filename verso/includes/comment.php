<?php

if (!function_exists('santos_comment')) {
function santos_comment($comment, $args, $depth) {
	
?>
													

<li id="comment-<?php echo comment_ID(); ?>" class="comment media"> 

		 <div class="thecomment">

			
			<div class="avatar-wrap media-left">
             <?php echo get_avatar($comment, 60); ?> 	
			</div>	

										
	
	<div id="div-comment-<?php echo comment_ID(); ?>" class="comment-text media-body">
	
	<h4 class="media-heading"><?php echo get_comment_author_link(); ?></h4>
	
	<div class="newsDate"><?php comment_time(); ?>, <?php comment_date(); ?> <?php comment_reply_link( array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']) ) ); ?> </div>

		
		<?php if ($comment->comment_approved == '0') : ?>
		<p><em><?php esc_html_e( 'Your comment is awaiting moderation.', 'santos'); ?></em></p>
		<?php endif; ?>


		<?php comment_text(); ?>
				
		
		
		 <div class="h-20"></div>
         <hr>
          <div class="h-20"></div>
						
						
		</div>
	                          
                

</div>
<?php 
}
}
?>