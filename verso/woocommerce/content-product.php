<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php post_class(); ?> data-aos="fade-up">

 <div class="col-md-12">
  <div class="newsBox shopBox">
                         
                   	 
		 
	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	//do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * woocommerce_before_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	 ?>
	 
	    <div class="relatedDiv text-center">
         <a href="<?php the_permalink(); ?>">   
        <?php 
		do_action( 'woocommerce_before_shop_loop_item_title' );	
		?>
		</a>
                              <div class="addToCartWrap">
                                <ul class="addToCartUl">
									<?php  do_action('santos_woocommerce_after_product_image'); ?>
                                </ul>
								</div>
                            </div>
	 
	 <?php
	

	/**
	 * woocommerce_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	 ?>
	 
	    <div class="contentBlogDiv text-center">
                                <a href="<?php the_permalink(); ?>">
        <?php do_action( 'woocommerce_shop_loop_item_title' ); ?>
                                </a>
                                <div class="shopePriceDiv">
                                  
                        				
	 <?php
	

	/**
	 * woocommerce_after_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );
	
	?>
	
	  </div>
             </div>
							
	<?php

	/**
	 * woocommerce_after_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	//do_action( 'woocommerce_after_shop_loop_item' );
	?>
	  </div>
	 </div>
</li>
