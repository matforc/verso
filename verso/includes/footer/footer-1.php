<?php

/* ================================================= 
Footer Layout 1
================================================== */ 

$footer_scheme = isset($santos_options['footer_color_scheme']) ? $santos_options['footer_color_scheme'] : 'darckBg';

if ( santos_get_post_id() && class_exists( 'RWMB_Field' ) ) {
	$post_id = santos_get_post_id();
	$footer_scheme = rwmb_meta( 'santos_footer_color_scheme',$args = array(),$post_id ) ? rwmb_meta( 'santos_footer_color_scheme',$args = array(),$post_id ) : $footer_scheme;
}


?>
	
<!-- footer section -->
 <footer class="footer-1 <?php echo esc_attr($footer_scheme).' '.esc_attr($enable_footer_class); ?>">
 
 <?php
 
 if ($enable_footer == 'true') {
	?>
	<div class="footer_top">	
        <div class="container">
				
            <div class="col-md-7 col-sm-6">
                <div class="col-md-6">
                <?php if ( function_exists('dynamic_sidebar') ) { 
				if ( is_active_sidebar( 'footer-column-1' ) ) :
				dynamic_sidebar('Footer Column 1');
				endif;
				} ?>
                </div>
                <div class="col-md-6">
                <?php if ( function_exists('dynamic_sidebar') ) { 
				if ( is_active_sidebar( 'footer-column-2' ) ) :
				 dynamic_sidebar('Footer Column 2'); 
				 endif;
				 } ?>
                </div>
            </div>

            <div class="col-md-5 col-sm-6">
                <?php if ( function_exists('dynamic_sidebar') ) { 
				if ( is_active_sidebar( 'footer-column-3' ) ) :
				 dynamic_sidebar('Footer Column 3'); 
				 endif;
				 } ?>
            </div>
        </div>
	</div>
	<?php
		}
	?>	
	
	<?php santos_sub_footer(); ?>


</footer>
<!-- / footer section -->
	