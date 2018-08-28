 <div id="sidebar" class="col-md-4 sidebar fixedsticky">
   <div class="sidebar">
		<?php if ( function_exists('dynamic_sidebar')) {
			
		global $woocommerce;
		
		if($woocommerce && is_shop() || $woocommerce && is_product_category() || $woocommerce && is_product_tag() || $woocommerce && is_product()){
			if ( is_active_sidebar( 'woocommerce-sidebar' ) ) : 	
			dynamic_sidebar('Woocommerce Sidebar');
			endif;
		}else{
			if ( is_active_sidebar( 'sidebar-widgets' ) ) : 
			dynamic_sidebar('Sidebar Widgets');
			endif;
		}	
			
			
			
		} 
		?>
	</div>
 </div>
