<?php get_header(); ?>
<!-- titlebar -->
<?php santos_titlebar(); ?>
<!--Shop -->


<?php 

//change to 2 columsn per row when using sidebar
if (!function_exists('loop_columns')) {
	function loop_columns() {
	  return 2; // 2 products per row
	}
}

$santos_options = get_option('santos_options'); 
	
?>


	
 <!-- shop container -->
 <?php
 if ( is_single()  ) {
	 echo '<div id="shops" class="padding-100">';
 }else{
	 echo '<div id="shops" class="padding-100 greySection">';
 }
 ?>
    
	
	
			<?php
				
				
				$santos_items = get_option( 'posts_per_page'); 
				
				if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
				elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
				else { $paged = 1; }

				$santos_main_class ="col-md-12";	
				
				if( ! is_product()){
					if (isset($santos_options['enable_fullwidth_shop']) && $santos_options['enable_fullwidth_shop'] == "1") {
					$santos_main_class = "col-md-12";
					}else{
						$santos_main_class = "col-md-8";
						add_filter('loop_shop_columns', 'loop_columns');
						
					}
				}
				
		
		
			?>
	
	
        <div class="container">
            <div class="shop_wrap <?php echo esc_attr($santos_main_class); ?>">
			
			

			 <?php 	woocommerce_content();  ?>

			<?php
			if( is_product()){
					if (isset($santos_options[ 'enable_product_share']) && $santos_options[ 'enable_product_share']=="1" ) { 
					
						if( class_exists( 'Santos_Core_Plugin' ) ) {
								
								santos_single_sharing_buttons(); 
								
						}
					}
			}	
			?>			
		

            </div>
			
			
			 <?php
			 if( ! is_product()){
				 
				if (isset($santos_options['enable_fullwidth_shop']) && $santos_options['enable_fullwidth_shop'] != "1") { ?>
				 
				  <?php get_sidebar(); ?>
				  			   
			<?php 
				}
			 }
			 ?>
				  
				  
           

        </div>
		
		
    </div>
    <!-- / shop container -->
	
	<?php  	if( is_product()){ 	do_action('santos_woocommerce_after_product_shop'); }  ?>


<?php get_footer(); ?>