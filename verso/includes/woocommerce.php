<?php 	

#-----------------------------------------------------------------#
# Woocommerce
#-----------------------------------------------------------------#

add_theme_support( 'woocommerce' );


// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter('woocommerce_add_to_cart_fragments', 'santos_woo_header_add_to_cart_fragment');
 
function santos_woo_header_add_to_cart_fragment( $fragments ) {
global $woocommerce;
ob_start();
?>
					<a class="shoping-cart-link dropdown-toggle" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" data-toggle="dropdown">
									 <i class="font-icon ion-bag"></i>
                                    <span class="amount badge"><?php echo esc_attr($woocommerce->cart->cart_contents_count); ?></span>
								</a>
<?php
$fragments['a.shoping-cart-link'] = ob_get_clean();
return $fragments;
}


//Remove wooCommerce Page Title
add_filter( 'woocommerce_show_page_title', '__return_false' );

//Remove wooCommerce description heading
add_filter( 'woocommerce_product_description_heading', 'remove_product_description_heading' );
function remove_product_description_heading() {
return '';
}


add_filter( 'get_product_search_form' , 'santos_custom_product_searchform' );

// woo_custom_product_searchform


function santos_custom_product_searchform( $form ) {
	?>
	<div class="search-field-wrap"><div class="search-field">
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" id="searchform" method="get">
		<input type="text" value="" placeholder="<?php esc_html_e('Search Products', 'santos' ); ?>" name="s" id="s" />
		<input type="submit" value="" />
		<input type="hidden" name="post_type" value="product" />
	</form>
</div> </div> 

<?php
		
}


// Display 12 products per page
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );


// remove default sorting dropdown
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

// Remove the result count from WooCommerce
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );


//change the position of add to cart
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
add_action('santos_woocommerce_after_product_image', 'woocommerce_template_loop_add_to_cart', 10);

//change the position of related single product
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
add_action( 'santos_woocommerce_after_product_shop', 'woocommerce_output_related_products', 20);


if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) {
	/**
	 * Show the product title in the product loop. By default this is an H3.
	 */
	function woocommerce_template_loop_product_title() {
		$tag = apply_filters( 'woocommerce_template_loop_product_title_tag', 'h4' );
		echo '<' . tag_escape( $tag ) . ' class="woocommerce-loop-product__title">' . get_the_title() . '</' . tag_escape( $tag ) . '>';
	}
}

if ( ! function_exists( 'woocommerce_template_loop_product_title_h2' ) ) {
	/**
	 * Modifies product title to H2 in the shop and product taxonomy loop.
	 */
	function woocommerce_template_loop_product_title_h2( $tag ) {
		if ( is_product_taxonomy() || is_shop() ) {
			$tag = 'h4';
		}
		return $tag;
	}
	add_filter( 'woocommerce_template_loop_product_title_tag', 'woocommerce_template_loop_product_title_h2' );
}




// Remove Star Rating from archive products
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );




/**
 * Replace WooCommerce Default Pagination with custom Pagination
 */
 
remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
add_action( 'woocommerce_after_shop_loop', 'santos_woocommerce_custom_pagination', 10);

function santos_woocommerce_custom_pagination() {
		
				if( get_next_posts_link() || get_previous_posts_link() ) { 
				echo '<nav aria-label="...">
                    <ul class="pager">
                        <li class="previous disabled">'.get_previous_posts_link('&larr; Older').'</li>
                        <li class="next">'.get_next_posts_link('Newer &rarr;','').'</li>
                    </ul>
                </nav>';
				}		

	}




// Image sizes
add_action( 'init', 'santos_woocommerce_image_dimensions', 1 );

// Define image sizes 
function santos_woocommerce_image_dimensions() {
	$catalog = array(
		'width' => '600',	
		'height'	=> '600',	
		'crop'	=> 1 
	);
	 
	$single = array(
		'width' => '1000',	
		'height'	=> '1000',	
		'crop'	=> 1 
	);
	 
	$thumbnail = array(
		'width' => '60',	
		'height'	=> '60',	
		'crop'	=> 1 
	);
	 
	
	update_option( 'shop_catalog_image_size', $catalog ); // Product category thumbs
	update_option( 'shop_single_image_size', $single ); // Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); // Image gallery thumbs
}



    