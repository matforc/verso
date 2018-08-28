<?php 

function santos_custom_dynamic_css() {
	
    
	$santos_options = get_option('santos_options');
    $output = '';
	$santos_theme_color = '#425bb5';
	$logo_width = 90;
	
	//Theme Colors
	if (isset($santos_options['theme_color']) ) {
	$santos_theme_color = $santos_options['theme_color'];
	}
	
	
	$santos_theme_color_rgb = santos_hex2rgb($santos_theme_color);



	// Theme Main Color CSS  

	$output .= '';
	
	
	if (isset($santos_options['logo_width']) && $santos_options['logo_width'] != "") {
    $logo_width = $santos_options['logo_width'];
    }
	
	$output .= '.navbar .navbar-brand img{ width:'.$logo_width.'px;}';
	
	
	
	$btn_radius = isset($santos_options['button_style']) ? $santos_options['button_style'] : 50;
	$output .= '.btn { border-radius: '.$btn_radius.'px;}';
	
	
	
	//$output .= '.premiumBox .priceNumber ,.premiumBox .priceTitle{ color: '.$santos_theme_color.';}';
	$output .= '.woocommerce-info::before {  color: '.$santos_theme_color.';}
	.badge, .btn-blue {  background: '.$santos_theme_color.';} ';
	
	
	$output .= '.newsBox:not(.quoteBox) .contentBlogDiv .post_title a:hover{color:'.$santos_theme_color.';}';
	$output .= '.contentBlogDiv a.newsDate{color:'.$santos_theme_color.';}';
	$output .= '.contactInfo h4{color:'.$santos_theme_color.';}';
	
	
	//woocommerce
	$output .= '.woocommerce span.onsale , .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
	.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,
	.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit.alt:focus, .woocommerce a.button.alt:focus, .woocommerce button.button.alt:focus, .woocommerce input.button.alt:focus
	{ background-color: '.$santos_theme_color.';} ';
	$output .= '.woocommerce ul.products li.product .price ins, .newPrice { color: '.$santos_theme_color.';}';
	$output .= '.addToCartUl li a, .addToCartUl li a.button { background: '.$santos_theme_color.';  border: 1px solid '.$santos_theme_color.';}';
	
	$output .= '.shopping-cart-header .widget_shopping_cart .buttons a, .woocommerce a.remove:hover { background: '.$santos_theme_color.';}';
	$output .= '.shopping-cart-header .widget_shopping_cart .woocommerce-mini-cart__buttons a.button:hover{ background: '.$santos_theme_color.'!important;opacity:.9;}';
	
	
	$output .= '#cd-zoom-in,#cd-zoom-out { background-color: rgba('.$santos_theme_color_rgb[0].','.$santos_theme_color_rgb[1].','.$santos_theme_color_rgb[2].',.9);}';
	
	
	/**
	* Wrap (body) background */
	$wrap_bg_color = '#FFFFFF';
	if (isset($santos_options['wrap_bg_color']) || $santos_options['wrap_bg_color'] != "") {
    $wrap_bg_color = $santos_options['wrap_bg_color'];
    }
	
	
	
	/**
	* Header background */
	
	$header_bg_scheme = isset($santos_options['header_bg_scheme']) ? $santos_options['header_bg_scheme'] : 'no-background';

	if (!empty($santos_options['header_bg_color']) || $santos_options['header_bg_color'] != "") {
    
    $header_bg_color = santos_hex2rgb($santos_options['header_bg_color']);
    }else{
      $header_bg_color = santos_hex2rgb('#FFFFFF');
    }
	
	
	/**
	* Header sticky */
	$sticky_menu_bg_color = isset($santos_options['sticky_menu_bg_color']) ? $santos_options['sticky_menu_bg_color'] : '#FFF';
	
	
	/**
	* Titlebar setting */
	$titlebar_extend_padding = isset($santos_options['titlebar_extend_padding']) ? $santos_options['titlebar_extend_padding'] : '200';
	
    
	
	$menu_link_light_color = isset($santos_options['menu_link_light_color']) ? $santos_options['menu_link_light_color'] : '#FFF';
	
	$output .= '@media (min-width: 1025px) {nav.navbar.light:not(.sticky) ul.nav li > a , nav.navbar.light:not(.sticky) .attr-nav > ul > li > a{color: '.$menu_link_light_color.'; }}';
	
	
	


if ( santos_get_post_id() && class_exists( 'RWMB_Field' ) ) {

	$post_id = santos_get_post_id();
    
    $header_bg_scheme  = rwmb_meta('santos_header_bg_scheme',$args = array(),$post_id) ? rwmb_meta('santos_header_bg_scheme',$args = array(),$post_id) : $header_bg_scheme;  
	$header_bg_color  = rwmb_meta('santos_header_bg_color',$args = array(),$post_id) ? santos_hex2rgb(rwmb_meta('santos_header_bg_color',$args = array(),$post_id)) : $header_bg_color;  
	//$header_bg_alpha  = rwmb_meta('santos_header_bg_opacity',$args = array(),$post_id) !='' ? rwmb_meta('santos_header_bg_opacity',$args = array(),$post_id) : $header_bg_alpha;       
	
	$wrap_bg_color  = rwmb_meta('santos_wrap_bg_color',$args = array(),$post_id) ? rwmb_meta('santos_wrap_bg_color',$args = array(),$post_id) : $wrap_bg_color;  
	
	$titlebar_extend_padding = rwmb_meta('santos_titlebar_extend_padding',$args = array(),$post_id) ? rwmb_meta('santos_titlebar_extend_padding',$args = array(),$post_id) : $titlebar_extend_padding;  
	
}	

if($header_bg_scheme == 'bg-color'){
	$output .= '@media (min-width: 1025px) {nav.navbar.navbar-default{background-color: rgb('.$header_bg_color[0].','.$header_bg_color[1].','.$header_bg_color[2].'); }}';
}



$output .= '.titleHedBgImg {padding: '.$titlebar_extend_padding.'px 0;}';



$output .= 'body > .wrapper{background-color:'.$wrap_bg_color.'; }';
	
	
	

	
	$output = preg_replace('/\r|\n|\t/', '', $output);
	wp_enqueue_style('custom-style',	get_template_directory_uri() . '/css/custom_style.css');
	wp_add_inline_style( 'custom-style', $output);
    

}
add_action( 'wp_enqueue_scripts', 'santos_custom_dynamic_css', 50);

?>