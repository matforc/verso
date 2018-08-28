<?php

/*
	*
	*	Theme Functions
	*	------------------------------------------------
	*	UXCODE Framework
	* 	Copyright http://www.uxcode.net
	*
	*	THEME DEFINITIONS
	*	THEME SETUP
	*	ENQUEUE SCRIPTS
	*	ENQUEUE STYLES
	*	FUNCTION INCLUDES
	*   THEME SIDEBAR WIDGETS
	*   CUSTOM FUNCTIONS

*/


#-----------------------------------------------------------------#
# Define theme constants
#-----------------------------------------------------------------#
$santos_theme = wp_get_theme();

define('SANTOS_VERSION', $santos_theme->get( 'Version' ), true);
define('SANTOS_NAME', $santos_theme->get( 'Name' ), true);
define("SANTOS_FRAMEWORK", get_template_directory() . "/framework");



if ( ! function_exists( 'santos_theme_setup' ) ) :
/**
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 */
function santos_theme_setup() {
	
	/*
	 * Make santos available for translation.
	 * Translations can be added to the /languages/ directory.
	 */
	load_theme_textdomain('santos', get_template_directory() . '/languages');


	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	
	 /*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded title tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	
	/* Enable support for Post Thumbnails.*/
	add_theme_support( 'post-thumbnails' );
	/* Enable support for Post Formats.*/
	add_theme_support( 'post-formats', array( 'video', 'audio','quote') );
	
	
	add_image_size( 'santos_default', 600, 400, true ); 
	add_image_size( 'santos_team', 600, 675, true );
	add_image_size( 'santos_portfolio_thumb', 600, 450, true );
	

	/* santos theme uses wp_nav_menu() in Primery locations.*/
	register_nav_menus( array(
		'primary_menu'   => esc_html__( 'Primary Navigation', 'santos' ),
		'second_menu' => esc_html__( 'Second Navigation', 'santos' ),
		'third_menu' => esc_html__( 'Third Navigation', 'santos' ),
		'top_left_menu'   => esc_html__( 'Top Left Navigation (for header style 2)', 'santos' ),
		'top_right_menu'   => esc_html__( 'Top Right Navigation (for header style 2)', 'santos' ),
		'footer_menu_1'   => esc_html__( 'Footer Navigation 1', 'santos' ),
		'footer_menu_2'   => esc_html__( 'Footer Navigation 2', 'santos' ),
		'footer_menu_3'   => esc_html__( 'Footer Navigation 3', 'santos' ),
	) );
	
	
	
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'framework/assets/css/editor-style.css', santos_google_fonts_url() ) );
	

}
endif; /* santos_theme_setup */
add_action( 'after_setup_theme', 'santos_theme_setup' );




add_action( 'admin_menu', 'santos_admin_menu' );
function santos_admin_menu(){
	if ( current_user_can( 'edit_theme_options' ) ) {
			
		add_theme_page ( 'Welcome to Santos', 'Welcome to Santos', 'manage_options', 'santos-welcome', 'santos_welcome_page' );
		add_theme_page ( 'System Status', 'System Status', 'manage_options', 'santos-system-status', 'santos_system_status_page' );
	}
}
function santos_welcome_page(){
	require_once get_template_directory() . '/framework/admin-pages/welcome.php';
}

function santos_system_status_page(){
	require_once get_template_directory() . '/framework/admin-pages/system_status.php';
}

#-----------------------------------------------------------------#
# Plugin Activation
#-----------------------------------------------------------------#
require_once get_template_directory() . '/framework/plugin-activation/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/framework/plugin-activation/required_plugins.php';

	
#-----------------------------------------------------------------#
# Register/Enqueue JS
#-----------------------------------------------------------------#
function santos_scripts_with_jquery()
{

	global $post;
	$santos_options = get_option('santos_options');
	

	if (!is_admin()) {
	
		/**
		* Third-party styles Not Prefixed to avoid loading twice if other plugin uses.
		*/
		
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'owl_carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'appear', get_template_directory_uri() . '/js/jquery.appear.js', array( 'jquery' ), null, true );	
		wp_enqueue_script( 'aos', get_template_directory_uri() . '/js/aos.js', array( 'jquery' ), null, true );
		
		
		/**
		* Prefixed to avoid Replace.
		*/
		
		wp_enqueue_script( 'santos-bootsnav', get_template_directory_uri() . '/js/bootsnav.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'santos-isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'santos-fixedsticky', get_template_directory_uri() . '/js/fixedsticky.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'santos-easings', get_template_directory_uri() . '/js/jquery.easings.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'santos-parallax', get_template_directory_uri() . '/js/parallax.js', array( 'jquery' ), null, true );
		
		
		
		// Register to use if needed
		wp_register_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ), null, true );
		wp_register_script( 'lightcase', get_template_directory_uri() . '/js/lightcase.js', array( 'jquery' ), null, true );
		wp_register_script( 'countTo', get_template_directory_uri() . '/js/jquery.countTo.js', array( 'jquery' ), null, true );
	
	
	
	if (isset($santos_options['enable_smooth_scroll']) && $santos_options['enable_smooth_scroll'] == "1") {
		
		wp_enqueue_script( 'santos-smoothscroll', get_template_directory_uri() . '/js/SmoothScroll.js', array( 'jquery' ), null, true );
		
	}
	
	
	
	/* Load the html5 shiv. */
	wp_enqueue_script( 'santos-html5', get_template_directory_uri() . '/js/html5shiv.js', array(), null );
	wp_script_add_data( 'santos-html5', 'conditional', 'lt IE 9' );
	
	/* comments */
	if ( is_singular() && comments_open() && get_option('thread_comments') )
	wp_enqueue_script('comment-reply');
	
	
	
	
	
	if(!is_404() && !is_search()){
	
		if(!$post) return false;
		$post_content = $post->post_content;
		
		$enable_onepage_navigator = rwmb_meta( 'santos_enable_onepage_navigator' );
		if( $enable_onepage_navigator == 'true' ) {
			wp_enqueue_script( 'santos-fullpage', get_template_directory_uri() . '/js/jquery.fullpage.min.js', array( 'jquery' ), null, true );
		}
		
		
		if( stripos( $post_content, '[santos_slider') ) {
		wp_enqueue_script( 'santos-multiscroll', get_template_directory_uri() . '/js/jquery.multiscroll.min.js', array( 'jquery' ), null, true );
		}
		
		
		if( stripos( $post_content, '[santos_down_count') ) {
		wp_enqueue_script( 'santos-downcount', get_template_directory_uri() . '/js/jquery.downCount.js', array( 'jquery' ), null, true );
		
		}
		
		
		

	}
	
		/* init Santos Custom Scripts */
		if (isset($santos_options['enable_minify']) && $santos_options['enable_minify'] == "1") {
			
			wp_enqueue_script( 'santos-script', get_template_directory_uri() . '/js/custom.min.js', array( 'jquery' ), null, true);
			
		}else{
			wp_enqueue_script( 'santos-script', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), null, true);
		}
	
	
	}  
	
}
add_action( 'wp_enqueue_scripts', 'santos_scripts_with_jquery' );







#-----------------------------------------------------------------#
# Register/ Enqueue CSS / ENQUEUE STYLES
#-----------------------------------------------------------------#
function santos_main_styles() {

	global $post;
	$santos_options = get_option('santos_options');
	
	
		/**
		* Third-party styles Not Prefixed to avoid loading twice if other plugin uses.
		*/
		 wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
		 wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/css/owl.carousel.min.css');
		 wp_enqueue_style('ionicons', get_template_directory_uri() . '/css/ionicons.min.css');
		 wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
		 wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.css');
		 wp_enqueue_style('aos', get_template_directory_uri() . '/css/aos.css');
		 
		 
		 
		wp_enqueue_style('santos-bootsnav', get_template_directory_uri() . '/css/bootsnav.min.css');

		
		wp_register_style('flexslider', get_template_directory_uri() . '/css/flexslider.css');
		wp_register_style('lightcase', get_template_directory_uri() . '/css/lightcase.css');
		
	
		 
		
		if(!is_404() && !is_search()){
	
		if(!$post) return false;
		$post_content = $post->post_content;

		
		$enable_onepage_navigator = rwmb_meta( 'santos_enable_onepage_navigator' );
		if( $enable_onepage_navigator == 'true' ) {
			wp_enqueue_style( 'santos-fullpage', get_template_directory_uri() . '/css/jquery.fullpage.min.css');
		}
		
		
		if( stripos( $post_content, '[santos_slider') ) {
		 wp_enqueue_style('santos-multiscroll', get_template_directory_uri() . '/css/jquery.multiscroll.css');
		}
		
		
		

		}
	
		 
		 /* Main CSS */
        wp_enqueue_style( 'santos-style' , get_stylesheet_uri(), array(), SANTOS_VERSION );
		
		
		/**
		 * Load our IE-only stylesheet for all versions of IE:
		 * <!--[if IE]> ... <![endif]-->
		 */
		wp_enqueue_style( 'santos-ie', get_template_directory_uri() . "/css/ie.css", array(), SANTOS_VERSION );
		wp_style_add_data( 'santos-ie', 'conditional', 'IE' );
		
		
	
		 
}

add_action('wp_enqueue_scripts', 'santos_main_styles');




// remove wp version param from any enqueued scripts
function santos_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'santos_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'santos_remove_wp_ver_css_js', 9999 );




#-----------------------------------------------------------------#
# Default Fonts
#-----------------------------------------------------------------#
/**
 * Register custom fonts.
 */
function santos_google_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';
	
	
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Lato, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'santos' ) ) {
		$fonts[] = 'Lato:400,400italic,700,700italic,800';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Lora, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Lora font: on or off', 'santos' ) ) {
		$fonts[] = 'Lora:400,400italic,700,700italic';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Raleway, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Raleway font: on or off', 'santos' ) ) {
		$fonts[] = 'Raleway:400,400italic,700,700italic';
	}
	
	
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Open Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Open+Sans font: on or off', 'santos' ) ) {
		$fonts[] = 'Open+Sans:400,400italic,700,700italic';
	}
	
	
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Playfair+Display, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Playfair+Display font: on or off', 'santos' ) ) {
		$fonts[] = 'Playfair+Display:400,400italic,700,700italic';
	}


	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}


	return esc_url_raw( $fonts_url );
}
  
/**
 * Enqueue scripts and styles.
 */
function santos_std_fonts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'santos-google-fonts', santos_google_fonts_url(), array(), null );

}
add_action( 'wp_enqueue_scripts', 'santos_std_fonts' );




#-----------------------------------------------------------------#
# Admin styles
#-----------------------------------------------------------------#
add_action('admin_enqueue_scripts', 'santos_admin_icons');
	function santos_admin_icons($hook) {
	
	if( $hook != 'post.php' && $hook != 'post-new.php' ) 
	return;

	wp_enqueue_style('ionicons', get_template_directory_uri() . '/css/ionicons.min.css');

	
}

#-----------------------------------------------------------------#
# Admin scripts
#-----------------------------------------------------------------#
add_action('admin_enqueue_scripts', 'santos_meta_scripts');
function santos_meta_scripts($hook) {
	
	if( $hook != 'appearance_page_santos-system-status' && $hook != 'appearance_page_santos-demos' && $hook != 'appearance_page_santos-welcome' && $hook != 'appearance_page_santos-options' && $hook != 'post.php' && $hook != 'post-new.php' ) 
		return;
	
	wp_enqueue_script('santos-meta-script', get_template_directory_uri() . '/framework/assets/js/meta.js', 'jquery', '1.0', true);
	wp_enqueue_style('chosen-css', get_template_directory_uri() . '/framework/assets/css/chosen.css');	
}




#-----------------------------------------------------------------#
# Framework Options
#-----------------------------------------------------------------#
if ( !class_exists( 'ReduxFramework' )  ) {
	require_once get_template_directory() . '/framework/ReduxCore/framework.php';
}
if ( !isset( $redux_demo )  ) {
	require_once get_template_directory() . '/framework/options/options-config.php';
}

/** remove redux menu under the tools **/
add_action( 'admin_menu', 'santos_remove_redux_menu',12 );
function santos_remove_redux_menu() {
    remove_submenu_page('tools.php','redux-about');
}




#-----------------------------------------------------------------#
# Meta Boxes
#-----------------------------------------------------------------#
require_once get_template_directory() . '/framework/meta-box/meta-box.php';
// Metabox Creation
require_once get_template_directory() . '/framework/meta-boxes.php';
// Custom field Creation
require_once get_template_directory() . '/framework/meta-box/inc/custom-fields/toggle.php'; 


if(is_admin()) {
	
if(!is_customize_preview()) {
		# Setup wizard by dtbaker https://github.com/dtbaker/envato-wp-theme-setup-wizard/tree/master/envato_setup
		require_once get_template_directory().'/framework/envato_setup/envato_setup.php';
}
}


#-----------------------------------------------------------------#
# Custom Comments
#-----------------------------------------------------------------#
require_once  get_template_directory() . '/includes/comment.php' ;


#-----------------------------------------------------------------#
# Custom Woocommerce Functions
#-----------------------------------------------------------------#
if ( class_exists( 'WooCommerce' ) ) {
require_once get_template_directory() . '/includes/woocommerce.php';
require_once get_template_directory() .'/framework/helpers/love-post.php'; 	
}





#-----------------------------------------------------------------#
# Custom CSS / JS
#-----------------------------------------------------------------#
require_once  get_template_directory() . '/css/custom-css.php' ;



#-----------------------------------------------------------------#
# THEME SIDEBAR WIDGETS
#-----------------------------------------------------------------#
add_action( 'widgets_init', 'santos_widgets_init' );
function santos_widgets_init() {
	

    register_sidebar(array(
		'id'   => 'sidebar-widgets',
		'name' => esc_html__('Sidebar Widgets','santos'),
		'description'   => esc_html__('Default sidebar widgets.','santos'),
    	'before_widget' => '<div id="%1$s" class="widget sidebar-div %2$s">',
    	'after_widget'  => '</div>',
    	'before_title'  => '<h4 class="sidebar-title">',
    	'after_title'   => '</h4>'
    ));
	
	register_sidebar(array(
		'id' => 'header-vertical-widget',
		'name' => esc_html__('Header Vertical Widget','santos'),
		'description'   => esc_html__( 'Header Layout (side) widgets.', 'santos' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-heading clearfix">',
		'after_title'   => '</div>'
	));
		
	if ( class_exists( 'WooCommerce' ) ) {
	register_sidebar(array(
		'id' => 'woocommerce-sidebar',
		'name' => esc_html__('Woocommerce Sidebar','santos'),
		'description'   => esc_html__( 'Woocommerce sidebar widgets.', 'santos' ),
		'before_widget' => '<div id="%1$s" class="widget sidebar-div %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="sidebar-title">',
    	'after_title'   => '</h3>'
	));
	}	
			
	

	register_sidebar(array(
		'id' => 'footer-column-1',
		'name' => esc_html__('Footer Column 1','santos'),
		'description'   => esc_html__( 'Footer Column 1 widgets.', 'santos' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-heading clearfix"><h4>',
		'after_title'   => '</h4></div>'
	));
	
	register_sidebar(array(
		'id' => 'footer-column-2',
		'name' => esc_html__('Footer Column 2','santos'),
		'description'   => esc_html__( 'Footer Column 2 widgets.', 'santos' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-heading clearfix"><h4>',
		'after_title'   => '</h4></div>'
	));
	
	register_sidebar(array(
		'id' => 'footer-column-3',
		'name' => esc_html__('Footer Column 3','santos'),
		'description'   => esc_html__( 'Footer Column 3 widgets.', 'santos' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-heading clearfix"><h4>',
		'after_title'   => '</h4></div>'
	));
		
	
}
	

#-----------------------------------------------------------------#
# Footer Navigation
#-----------------------------------------------------------------#
if (!function_exists('santos_footer_navigation')) {
	function santos_footer_navigation($location) {
		
	$menu_output = "";
	$footer_menu_args = array(
	'echo'=> false,
	'theme_location' => $location,
	'container' => '',
	'menu_class' =>'',
	'menu_id' =>'',
	'items_wrap' => '%3$s' ,
	'depth' => 1 
	); 


	$menu_output .= '<ul class="footerLinks">'. "\n";		

	if(has_nav_menu($location)) {
	$menu_output .= wp_nav_menu( $footer_menu_args );
	}

	$menu_output .= '</ul>'. "\n";

	echo do_shortcode($menu_output);
		
			
	}
}


#-----------------------------------------------------------------#
# Mailchimp widget
#-----------------------------------------------------------------#
if (!function_exists('santos_mailchimp_subscribe_widget')) {
	function santos_mailchimp_subscribe_widget() {
		

$santos_options = get_option('santos_options'); 

	
$output = $chimp_url = $chimp_submit_msg = $chimp_success_msg = $chimp_error_invalid_value = $chimp_error_invalid_sign = $chimp_error_invalid_domain = $chimp_error_invalid_username = $chimp_error_invalid_email =  '';

$chimp_url = $santos_options['chimp_url'];
$chimp_submit_msg = $santos_options['chimp_submit_msg'];
$chimp_success_msg = $santos_options['chimp_success_msg'];
$chimp_error_invalid_value = $santos_options['chimp_error_invalid_value'];
$chimp_error_invalid_sign = $santos_options['chimp_error_invalid_sign'];
$chimp_error_invalid_domain = $santos_options['chimp_error_invalid_domain'];
$chimp_error_invalid_username = $santos_options['chimp_error_invalid_username'];
$chimp_error_invalid_email = $santos_options['chimp_error_invalid_email'];

wp_enqueue_script( 'santos-ajaxchimp', get_template_directory_uri() . '/js/jquery.ajaxchimp.min.js', array( 'jquery' ), '1.0', true );


$output .= '<!-- ===== MAILCHIMP FORM STARTS ===== -->
	
	    <div class="subscribe-widget clearfix">
                    <h4>'.__('Subscribe to Our Newsletter','santos').'</h4>
                    <form class="santos_mail_chimp subscription-form mailchimp inputSubscribeDiv" data-mailchimp-url="'.$chimp_url.'" data-submit-msg="'.$chimp_submit_msg.'" data-success="'.$chimp_success_msg.'"  data-error-value="'.$chimp_error_invalid_value.'" data-error-sign="'.$chimp_error_invalid_sign.'" data-error-domain="'.$chimp_error_invalid_domain.'" data-error-username="'.$chimp_error_invalid_username.'" data-error-email="'.$chimp_error_invalid_email.'" >
                    
				
				 <div class="notify">
						<input type="email" name="subscribe" class="form-control " placeholder="'.__('Enter your Email','santos').'">
                        <button class="btn btn-blue" type="submit">'.__('Subscribe','santos').'</button>
                 </div> 
				 
				 <!-- SUBSCRIPTION SUCCESSFUL OR ERROR MESSAGES -->
				<span class="subscription-success"> </span>
				<span class="subscription-error"> </span>
				 
				 </form><!-- /END MAILCHIMP FORM Ends -->
                </div>
				';

echo do_shortcode($output);
	
			
	}
}




#-----------------------------------------------------------------#
# Menu Walker
#-----------------------------------------------------------------#
require_once get_template_directory() . '/framework/nav_custom.php'; 
require_once get_template_directory() . '/framework/nav_walker.php' ;



#-----------------------------------------------------------------#
# Breadcrumbs
#-----------------------------------------------------------------#
require_once get_template_directory() . '/includes/breadcrumbs.php'; 


#-----------------------------------------------------------------#
# Wp Staff
#-----------------------------------------------------------------#	
/*Content Width*/
if ( ! isset( $content_width ) ) {
	$content_width = 1000;
}

/*excerpt length*/
function santos_excerpt_length( $length ) {
	$santos_options = get_option('santos_options'); 
	$santos_excerpt_length = (!empty($santos_options['blog_excerpt_length'])) ? intval($santos_options['blog_excerpt_length']) : 30; 
    return $santos_excerpt_length;
}
add_filter( 'excerpt_length', 'santos_excerpt_length', 999 );


/*custom excerpt ending*/
function santos_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'santos_excerpt_more');


//Excerpt Limit
if (!function_exists('santos_excerpt_limit')) {
function santos_excerpt_limit($length='') {
    

   $santos_options = get_option('santos_options');

    if($length !=''){
         $limit=$length;
    }else {
    
    if (isset($santos_options['blog_excerpt_length']) && $santos_options['blog_excerpt_length'] != "") { 
    $limit = $santos_options['blog_excerpt_length'];
    }else{
    $limit='45';   
    }
    }
    
    

	$excerpt = explode(' ', get_the_excerpt(), $limit); 

  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';

  } else {
    $excerpt = implode(" ",$excerpt);
  }            

  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;

}
}




#-----------------------------------------------------------------#
# BODY CLASSES - Add class on body ayout 
#-----------------------------------------------------------------#
if (!function_exists('santos_body_classes')) {
function santos_body_classes($classes) {

	$santos_options = get_option('santos_options');

	$header_layout = !empty($santos_options['header_layout']) ? $santos_options['header_layout'] : 'header-1';
	
	if ( santos_get_post_id() && class_exists( 'RWMB_Field' ) ) {
	$post_id = santos_get_post_id();
	$header_layout = rwmb_meta( 'santos_header_layout',$args = array(),$post_id ) ? rwmb_meta( 'santos_header_layout',$args = array(),$post_id ) : $header_layout;
	}
	
	if($header_layout == 'header-3'){
		$classes[] = 'vertical-header-enabled';
	}


	
	return $classes;
}
add_filter('body_class','santos_body_classes');
}


#-----------------------------------------------------------------#
# Add Gravatar Class
#-----------------------------------------------------------------#
add_filter('get_avatar','santos_add_gravatar_class');

function santos_add_gravatar_class($class) {
    $class = str_replace("class='avatar", "class='avatar img-circle author-img", $class);
    return $class;
}




#-----------------------------------------------------------------#
# Favicon
#-----------------------------------------------------------------#
if (!function_exists('santos_favicon')) {
function santos_favicon() {
	
		if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
		
		$santos_options = get_option('santos_options');		
		
		if (isset($santos_options['favicon']) && isset($santos_options['favicon']['url'])) { 
		$santos_favicon = $santos_options['favicon'];	?>
		<link rel="shortcut icon" href="<?php echo esc_attr($santos_favicon['url']); ?>" type="image/x-icon" />		
		<?php }else{ ?>
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.png"  />
        <?php } 

		}	
		
			
	}
}



#-----------------------------------------------------------------#
# Preloader
#-----------------------------------------------------------------#
if (!function_exists('santos_preloader')) {
function santos_preloader() {
	
	$santos_options = get_option('santos_options');	
	
	if (isset($santos_options['enable_preloader']) && $santos_options['enable_preloader'] == "1") { 
	?>
	
<!--###################################
############   loading_screen     ########
##################################### -->
    <div class="loading_screen">
        <div class="showbox">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
            </svg>
        </div>
    </div>
	
	<?php	
	}	
			
	}
}


#-----------------------------------------------------------------#
# Return Post ID */
#-----------------------------------------------------------------#
if (!function_exists('santos_get_post_id')) {
function santos_get_post_id()
{
global $post;

if (class_exists( 'WooCommerce' ) && is_woocommerce() && is_shop()) {
return wc_get_page_id('shop');
} 
else if (is_singular()) {
return get_the_ID();
} 
else if (is_home()) {
$page_on_front = get_option('page_on_front');
$show_on_front = get_option('show_on_front');
if ($page_on_front == 'page' && !empty($page_on_front)) {
return $post->ID;
}
else if(get_option( 'page_for_posts' )){
return get_option( 'page_for_posts' );
}
else {
return false;
}
} 
else {
return false;
}
}
}

#-----------------------------------------------------------------#
# Header Navigation
#-----------------------------------------------------------------#
if (!function_exists('santos_primary_navigation')) {
function santos_primary_navigation() {
	
	
$santos_options = get_option('santos_options');
$post_id = santos_get_post_id();
$template_name = '';

if(is_page()){
$template_name = get_post_meta( $post_id, '_wp_page_template', true );
}	

if (is_404()) { return; }

if ( is_page_template('comming-soon-template.php') || $template_name == 'comming-soon-template.php' ) { return; } 

$header_layout = 'header-1';	
if (isset($santos_options['header_layout']) && $santos_options['header_layout'] != "") {
$header_layout = $santos_options['header_layout'];
}
	 
$header_scheme = 'dark';	
if (isset($santos_options['header_scheme']) && $santos_options['header_scheme'] != "") {
$header_scheme = $santos_options['header_scheme'];
}


if( class_exists( 'WooCommerce' ) && is_product()){
	
	if (isset($santos_options['product_header_scheme']) && $santos_options['product_header_scheme'] != "") {
	$header_scheme = $santos_options['product_header_scheme'];
	}
	
}

$header_bg_scheme = 'no-background';	
if (isset($santos_options['header_bg_scheme']) && $santos_options['header_bg_scheme'] != "") {
$header_bg_scheme = $santos_options['header_bg_scheme'];
}

$header_transparent_style = 'white';	
if (isset($santos_options['header_transparent_style']) && $santos_options['header_transparent_style'] != "") {
$header_transparent_style = $santos_options['header_transparent_style'];
}


$menu_align = 'center';	
if (isset($santos_options['menu_align']) && $santos_options['menu_align'] != "") {
$menu_align = $santos_options['menu_align'];
}

$enable_head_search = 'false';
if (isset($santos_options['enable_head_search']) && $santos_options['enable_head_search'] == "1") {
	$enable_head_search = 'true';
}

$enable_head_cart = 'false';
if (isset($santos_options['enable_head_cart']) && $santos_options['enable_head_cart'] == "1") {
	$enable_head_cart = 'true';
}


$sticky_header = '';
if (isset($santos_options['enable_sticky_header']) && $santos_options['enable_sticky_header'] != "1") {
	$sticky_header = 'no-sticky';
}


$menu_location = 'primary_menu';

$header_custom_logo = $header_custom_logo_url = '';
$enable_head_icons = 'true';			

if (is_singular()) {
	if($post_id && class_exists( 'RWMB_Field' ) ) {
	$header_layout = rwmb_meta( 'santos_header_layout' ) ? rwmb_meta( 'santos_header_layout' ) : $header_layout;
	$header_scheme = rwmb_meta( 'santos_header_scheme' ) ? rwmb_meta( 'santos_header_scheme' ) : $header_scheme;
	$header_bg_scheme = rwmb_meta( 'santos_header_bg_scheme' ) ? rwmb_meta( 'santos_header_bg_scheme' ) : $header_bg_scheme;
	$menu_align = rwmb_meta( 'santos_menu_align' ) ? rwmb_meta( 'santos_menu_align' ) : $menu_align;
	
	
	$enable_head_icons = rwmb_meta( 'santos_enable_head_icons' ) ? rwmb_meta( 'santos_enable_head_icons' ) : $enable_head_icons;
	
	$menu_location = rwmb_meta( 'santos_page_menu_location' ) ? rwmb_meta( 'santos_page_menu_location' ) : $menu_location;
	
	
	
	$header_custom_logo = rwmb_meta( 'santos_logo_custom_image', 'type=image&size=full');   

	if($header_custom_logo){
		 
		 foreach($header_custom_logo as $custom_logo){
		 $header_custom_logo_url = $custom_logo["url"];
		 break;
		 }
	}
		
 
	}
}


if ( is_archive() || is_home() ) {
	

    if (isset($santos_options['archive_header_scheme']) && $santos_options['archive_header_scheme'] != "") {
	$header_scheme = $santos_options['archive_header_scheme'];
	}else{
	 $header_scheme = $header_scheme;
	}
	
}	

if(class_exists( 'WooCommerce' ) && is_archive()){
	
	 if (isset($santos_options['shop_header_scheme']) && $santos_options['shop_header_scheme'] != "") {
	$header_scheme = $santos_options['shop_header_scheme'];
	}else{
	$header_scheme = $header_scheme;
	}
	
	
}
	


	
if($header_layout == 'header-1' || $header_layout == 'header-2'){
	
	$center_logo_class = '';
	
	if($header_layout == 'header-2'){	
	$center_logo_class = 'brand-center';
	}
	
	?>
	

		
	<!-- navbar -->
    <nav class="navbar navbar-fixed  <?php  echo esc_attr($header_layout).' '. esc_attr($center_logo_class).' '. esc_attr($header_bg_scheme).' '.esc_attr($header_transparent_style).' '.esc_attr($sticky_header);   ?>  navbar-default  bootsnav <?php if($header_scheme == 'light' ){ echo 'light'; } ?>  darckDropdown" data-minus-value-desktop="58" data-minus-value-mobile="55" data-speed="500">

	<?php
	if ($enable_head_search == "true"){
		?>
        <!-- Start Top Search -->
        <div class="top-search">
            <div class="container">
			    <form action="<?php echo esc_url( home_url( '/' ) ); ?>" id="searchform_top" method="get">	
                <div class="input-group">
				
                    <span class="input-group-addon"><i class="ion-ios-search-strong"></i></span>
                    <input type="text" class="form-control" placeholder="<?php esc_attr_e('Cerca','santos'); ?>" name="s">
					<input type="submit" value="" />
                    <span class="input-group-addon close-search"><i class="font-icon ion-close-round"></i></span>
				 
                </div>
				</form>
            </div>
        </div>
        <!-- End Top Search -->
	<?php } ?>
       
	   <div class="container">
            <!-- Start Atribute Navigation -->
			<?php
			if($enable_head_icons == 'true'){
					
			?>
            <div class="attr-nav">
                <ul>
				<?php
				if ($enable_head_search == "true"){
					?>
                    <li class="search"><a href="#"><i class="font-icon ion-ios-search-strong"></i></a></li>
					<?php }  

					?>
					
					
			<?php	
				if ($enable_head_cart == "true"){ 
					if ( class_exists('woocommerce') ) {
					global $woocommerce; 
					?>					
					
					<li class="dropdown head_shop_icon">
							
			
					<a class="shoping-cart-link dropdown-toggle" href="<?php echo wc_get_cart_url(); ?>" data-toggle="dropdown">
									 <i class="font-icon ion-bag"></i>
                                    <span class="amount badge"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
								</a>
					
					  <ul class="dropdown-menu shopping-cart-header darckBg animated" style="display: none; opacity: 1;">
						  <li>
							<?php the_widget( 'WC_Widget_Cart'); ?>
							</li>

					 </ul>				


                </li>
				
				
					<?php

					}
				}
?>
				
				
                </ul>
				
				<div class="clearboth"></div>
            </div>
			<?php 
			}
			?>
            <!-- End Atribute Navigation -->

            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <span class="menuDiv">
                        <span class="menu-line"></span>
                    </span>
                </button>
				
				
		
	 <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
	<?php
	global $logo_html , $sticky_logo_html;
	$logo_html = $sticky_logo_html = '';
	
	
	if($header_custom_logo_url != '' ){
		
		$logo_html = '<img src="' . $header_custom_logo_url . '" class="logo logo-display" alt="'. get_bloginfo('name') .'" />';
		
	}else{	
		if($header_scheme == 'light' ){ 
		
			if (isset($santos_options['logo_light']) && $santos_options['logo_light']['url'] != "") { 

			$logo_light = $santos_options['logo_light'];
			$logo_html = '<img src="' . $logo_light['url'] . '" class="logo logo-display" alt="'. get_bloginfo('name') .'" />';
			}else { 
			$logo_html = '<span class="site-title logo-display">'. get_bloginfo('name') .'</span>'; 
			}
		
		}else{
			
			if (isset($santos_options['logo']) && $santos_options['logo']['url'] != "") { 

			$logo = $santos_options['logo'];
			$logo_html = '<img src="' . $logo['url'] . '" class="logo logo-display" alt="'. get_bloginfo('name') .'" />';
			}else { 
			$logo_html = '<span class="site-title logo-display">'. get_bloginfo('name') .'</span>'; 
			}
		}
	}	
	
	echo do_shortcode($logo_html);
	
	if (isset($santos_options['logo_sticky']) && $santos_options['logo_sticky']['url'] != "") {
		//ATENA 140218
            if($header_custom_logo_url != '' ){

                $sticky_logo_html = '<img src="' . $header_custom_logo_url . '" class="logo logo-scrolled" alt="'. get_bloginfo('name') .' Will Coffee" />';

            }else {
                $logo_sticky = $santos_options['logo_sticky'];
                $sticky_logo_html = '<img src="' . $logo_sticky['url'] . '" class="logo logo-scrolled" alt="'. get_bloginfo('name') .'" />';
            }

        } else {
        $sticky_logo_html = '<span class="site-title logo-scrolled">'. get_bloginfo('name') .'</span>';
        }
	
	    echo do_shortcode($sticky_logo_html);
	?>
	
	 
                </a>
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
			
			
			<?php 
			
			$menu_output = "";
							
				
			if($header_layout == 'header-2'){

			$left_menu_args = array(
				  'echo'=> false,
                  'theme_location' => 'top_left_menu',
                  'container' => '',
				  'menu_class' =>'',
				  'menu_id' =>'',
				  'items_wrap' => '%3$s' ,
				  'walker' => new santos_nav_walker(),
                  'depth' => 0 
                ); 

			$right_menu_args = array(
				  'echo'=> false,
                  'theme_location' => 'top_right_menu',
                  'container' => '',
				  'menu_class' =>'',
				  'menu_id' =>'',
				  'items_wrap' => '%3$s' ,
				  'walker' => new santos_nav_walker(),
                  'depth' => 0 
                );
				
				
			$menu_output .= '<div class="col-half left"><ul class="nav navbar-nav navbar-left" data-in="" data-out="">'. "\n";		
			
			 if(has_nav_menu('top_left_menu')) {
				$menu_output .= wp_nav_menu( $left_menu_args );
			}

			$menu_output .= '</ul></div>'. "\n";	



			$menu_output .= '<div class="col-half right"><ul class="nav navbar-nav navbar-right">'. "\n";		
			
			 if(has_nav_menu('top_right_menu')) {
				$menu_output .= wp_nav_menu( $right_menu_args );
			}

			$menu_output .= '</ul></div>'. "\n";		
				
			}else{
				
				
				
				$main_menu_args = array(
				  'echo'=> false,
                  'theme_location' => $menu_location,
                  'container' => '',
				  'menu_class' =>'',
				  'menu_id' =>'',
				  'items_wrap' => '%3$s' ,
				  'walker' => new santos_nav_walker(),
                  'depth' => 0 
                ); 
				
			$menu_output .= '<ul class="nav navbar-nav navbar-align-'.$menu_align.'" data-in="" data-out="">'. "\n";		
			
			 if(has_nav_menu($menu_location)) {
				$menu_output .= wp_nav_menu( $main_menu_args );
			}

			$menu_output .= '</ul>'. "\n";	
				
				
			}
			

			
			
			
			echo do_shortcode($menu_output);
			
			?>
			
			</div>
			<!-- /.navbar-collapse -->
        </div> <!-- /.container -->
    </nav>
    <!-- / navbar -->
	
	<?php
	
}else if($header_layout == 'header-3'){
		  
	?> 
		  
	<!-- navbar -->
    <nav class="navbar navbar-sidebar <?php echo esc_attr($header_layout).' '. esc_attr($header_bg_scheme).' '.esc_attr($header_transparent_style); ?> navbar-default bootsnav  <?php if($header_scheme == 'light' ){ echo 'light'; } ?>  darckDropdown">

       
	   <div class="container">
	   
	    <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <span class="menuDiv">
                        <span class="menu-line"></span>
                    </span>
                </button>
             	 <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php
				
			
			if($header_custom_logo_url != '' ){
		
				echo '<img src="' . $header_custom_logo_url . '" class="logo logo-display" alt="'. get_bloginfo('name') .'" />';
				
			}else{		
				if($header_scheme == 'light' ){ 
				
					if (isset($santos_options['logo_light']) && $santos_options['logo_light']['url'] != "") { 

					$logo_light = $santos_options['logo_light'];
					echo '<img src="' . $logo_light['url'] . '" class="logo logo-display" alt="'. get_bloginfo('name') .'" />';
					}else { 
					echo '<span class="site-title logo-display">'. get_bloginfo('name') .'</span>'; 
					}
				
				}else{
					
					if (isset($santos_options['logo']) && $santos_options['logo']['url'] != "") { 

					$logo = $santos_options['logo'];
					echo '<img src="' . $logo['url'] . '" class="logo logo-display" alt="'. get_bloginfo('name') .'" />';
					}else { 
					echo '<span class="site-title logo-display">'. get_bloginfo('name') .'</span>'; 
					}
				}
			}	
			
			
			if (isset($santos_options['logo_sticky']) && $santos_options['logo_sticky']['url'] != "") {


			$logo_sticky = $santos_options['logo_sticky'];
			$sticky_logo_html = '<img src="' . $logo_sticky['url'] . '" class="logo logo-scrolled" alt="'. get_bloginfo('name') .'" />';
			} else {
			$sticky_logo_html = '<span class="site-title logo-scrolled">'. get_bloginfo('name') .'</span>';
			}

			echo do_shortcode($sticky_logo_html);
	
				?>
	
	 
				</a>
				
            </div>
            <!-- End Header Navigation -->
			
			

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
			
			
			<?php 
					
				$menu_output = "";
				$main_menu_args = array(
				  'echo'=> false,
                  'theme_location' => $menu_location,
                  'container' => '',
				  'menu_class' =>'',
				  'menu_id' =>'',
				  'items_wrap' => '%3$s' ,
				  'walker' => new santos_nav_walker(),
                  'depth' => 0 
                ); 
				
				
			$menu_output .= '<ul class="nav navbar-nav navbar-align-'.$menu_align.'" data-in="" data-out="">'. "\n";		
			
			 if(has_nav_menu($menu_location)) {
				$menu_output .= wp_nav_menu( $main_menu_args );
			}

			$menu_output .= '</ul>'. "\n";

			echo do_shortcode($menu_output);
			
			?>
			
			</div>
			<!-- /.navbar-collapse -->
			
			
			<?php 
			
				if ( function_exists('dynamic_sidebar') ) { 
				if ( is_active_sidebar( 'header-vertical-widget' ) ) : 
			
				 dynamic_sidebar('Header Vertical Widget'); 
			
				 endif; 
				} 
				?>
				
			
        </div> <!-- /.container -->
    </nav>
    <!-- / navbar -->
	
	<?php
		  
	  }
	}
}



function santos_center_nav_menu_logo($items, $args) {
	if ( $args->theme_location == 'primary_menu') {
		if (is_array($items) || is_object($items)) {
			global $logo_html , $sticky_logo_html;
			$logo = $logo_html . $sticky_logo_html;
			$menu_items = array();
			foreach ($items as $key => $item) {
				if ($item->menu_item_parent == 0) $menu_items[] = $key;
			}
			
			
			$new_item_array = array();
			$new_item = new stdClass;
			$new_item->ID = 0;
			$new_item->db_id = 0;
			$new_item->menu_item_parent = 0;
			$new_item->url =  home_url( '/' );
			$new_item->title = $logo;
			$new_item->menu_order = 0;
			$new_item->object_id = 0;
			$new_item->description = '';
			$new_item->attr_title = '';
			$new_item->button = '';
			$new_item->megamenu = '';
			$new_item->logo = true;
			$new_item->classes = 'menu-item navbar-brand mobile-hidden tablet-hidden';
			$new_item_array[] = $new_item;
			$get_position = round(count($menu_items) / 2) - 1;
			array_splice($items, $menu_items[$get_position], 0, $new_item_array);
		}
	}

	return $items;
}




#-----------------------------------------------------------------#
# Titlebar
#-----------------------------------------------------------------#
if (!function_exists('santos_titlebar')) {
function santos_titlebar(){
	
	
	$post_id = santos_get_post_id();
	$post = get_post($post_id);
	
	if(is_single()){
	$author_id = $post->post_author;
	$author = get_userdata( $author_id  ); 
	}
	
	
	$santos_options = get_option('santos_options');  
	
	$titlebar_style = isset($santos_options['default_titlebar_style']) ? $santos_options['default_titlebar_style'] : 'minimal';
	
	$titlebar_style = rwmb_meta( 'santos_titlebar_style') ? rwmb_meta( 'santos_titlebar_style') : $titlebar_style ;

	$header_bg_images = $header_bg_image_url = $cats = '';
	
	
	 if ( $post_id && ( rwmb_meta( 'santos_enable_titlebar' ) == 'false' ) ) {
			return false;
		}
	
		if ( is_single() &&  "product" == get_post_type() && ( rwmb_meta( 'santos_enable_titlebar' ) != 'true' )) {
			
		if (isset($santos_options['enable_product_titlebar']) && $santos_options['enable_product_titlebar'] == 0) {
			return false;
		}	
			
				
		}

	if($titlebar_style == 'custom_img' )
	{
			
		$header_bg_images = rwmb_meta( 'santos_titlebar_custom_image', 'type=image&size=full');   

		 if($header_bg_images){
		 
		 foreach($header_bg_images as $header_bg_image){
		 $header_bg_image_url = $header_bg_image["url"];
		 break;
		 }
		 }
	}else if($titlebar_style == 'feature_image'){
		
		if ( has_post_thumbnail()) {
		$header_bg_images = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "full" );
		$header_bg_image_url = $header_bg_images[0];
		} 
	}
	
	$header_bg_image_url = $header_bg_image_url ? $header_bg_image_url : $santos_options['titlebar_extend_bg_img']['url'];
	

	if ( is_singular() && post_type_exists( 'santos-portfolio' ) && taxonomy_exists('santos-portfolio-category') ) {


		$item_categories = get_the_terms( $post->ID, 'santos-portfolio-category' );


		if($item_categories && !is_wp_error($item_categories) ){
		$i=0;

		foreach ($item_categories as $item){
			
			if($i!=0){ 
			$cats .= '<span class="cat_slash">/</span> ';
			}
			$cats .= '<a href="'. get_term_link( $item->slug, 'santos-portfolio-category' ) .'">'.$item->name .'</a> ';
			$i++;
			}

		}
		
	}
	

	$title = $title_bg_color = '';
	$title = get_the_title();
	
	if ( is_archive() && !(is_woocommerce()) ) {
	$title	= get_the_archive_title();
	}
	

	if (class_exists( 'WooCommerce' ) && is_woocommerce() && is_archive()) {
			$shop_page_id = wc_get_page_id('shop');
			$shop_page = get_post($shop_page_id);
				if ($shop_page_id && $shop_page && get_option('page_on_front') !== $shop_page_id) {
						$title = $shop_page->post_title;
			}else{
				$title = esc_html__('Our Shop', 'santos');
			}
	$title_bg_color = 'backgrondGrey';	


	if (isset($santos_options['shop_titlebar_style']) && $santos_options['shop_titlebar_style'] !='') {
	$titlebar_style = $santos_options['shop_titlebar_style']; 
	}
	
	if($titlebar_style == 'custom_img' )
	{
		
		$title_bg_color = $santos_options['titlebar_extend_bg_color'];
		if(isset($santos_options['shop_titlebar_bg_img']['url'])){
		$header_bg_image_url = $santos_options['shop_titlebar_bg_img']['url']; 
		}
	
	}


	
	}	

	
 ?>
	 
	<!-- title Hed not minimal -->
	<?php
	if($titlebar_style != 'minimal' )
	{
		
		$titlebar_bg_color = rwmb_meta( 'santos_titlebar_bg_color') ? rwmb_meta( 'santos_titlebar_bg_color') :  $santos_options['titlebar_extend_bg_color']; 
		$titlebar_bg_img = $header_bg_image_url; 
		?>
		
		
		<div class="titleHed titleHedBgImg background parallax" style="background-color:<?php echo esc_attr($titlebar_bg_color); ?>; <?php if($titlebar_style != 'color' ){ ?> background-image:url(<?php echo esc_url($titlebar_bg_img); ?>); <?php } ?>" data-img-width="1600" data-img-height="1064" data-diff="100">
		
	<?php
	if($titlebar_style != 'color' )
	{
	?>
		<div class="titleHedOverlay"></div>
	<?php
	}	
	?>
			  <div class="container">
					<div class="col-md-10 col-md-offset-1">
							<?php 
							if ( is_single() &&  "post" == get_post_type() ) {
								?>
								<a class="newsDate"><?php echo get_the_date(); ?></a>
								<?php
							}
								
							if ( is_single() &&  "santos-portfolio" == get_post_type() ) {	
							if($item_categories){ echo '<span class="itemsCat">' .$cats .'</span>'; } 
							}
							
							?>
							<h1><?php echo esc_attr($title); ?></h1>
							<div class="h-20"></div>
								
								<?php
								if ( is_single() &&  "post" == get_post_type() ) {
									?>
									<div class="personDiv">
									<?php echo get_avatar( $author->user_email , 30 ); ?>
									<span>by <a href="<?php echo get_author_posts_url( $post->post_author ); ?>"><?php echo esc_attr($author->nickname); ?></a> <?php  //the_author_meta( 'nickname', $author_id ); //the_author_posts_link(); ?> | <?php esc_html_e('in','santos'); ?> <?php the_category(', '); ?></span>
									</div>
									
									<?php
								}else{
									?>
										
									 <div class="breadcrumbDiv">
									<?php  santos_breadcrumbs(); ?>
									</div>	
									
									<?php
								}
								?>

					</div>
			</div>
		</div>	
		
	<?php
	}else{
		
		
	?>
		<div class="titleHed <?php echo esc_attr($title_bg_color); ?>">
			<div class="container">
				<div class="col-md-10 col-md-offset-1">
				
					<div class="text-center blogTitle">
								<?php 
								if ( is_single() &&  "post" == get_post_type() ) {
								?>
								<a class="newsDate"><?php echo get_the_date(); ?></a>
								<?php
								}
								
								if ( is_single() &&  "santos-portfolio" == get_post_type() ) {	
								if($item_categories){ echo '<span class="itemsCat">' .$cats .'</span>'; } 
								}
								?>
								<h1><?php echo esc_attr($title); ?></h1>
								<div class="h-20"></div>
								
								<?php
								if ( is_single() &&  "post" == get_post_type() ) {
									?>
									<div class="personDiv">
									<?php echo get_avatar( $author->user_email, 30 ); ?>
									<span>by <a href="<?php echo get_author_posts_url( $post->post_author ); ?>"><?php echo esc_attr($author->nickname); ?></a> | <?php esc_html_e('in','santos'); ?> <?php the_category(', '); ?></span>
									</div>
									
									<?php
								}else{
									?>
										
									 <div class="breadcrumbDiv">
									<?php santos_breadcrumbs(); ?>
									</div>	
									
									<?php
								}
								?>

					</div>
				</div>	
			</div>
		</div>	

			<?php	
	}
	?>

	<!-- / title Hed -->
	
<?php	
	
}
}

#-----------------------------------------------------------------#
# Get Footer Function
#-----------------------------------------------------------------#
function santos_footer_layout(){

$footer_layout = "footer-1";
$santos_options = get_option('santos_options');	
$post_id = santos_get_post_id();

$enable_footer = 'false';
$enable_footer_class = "";

if(isset($santos_options['footer_layout'])){
$footer_layout = $santos_options['footer_layout'];	
}

	
	
	if (isset($santos_options['enable_footer']) && $santos_options['enable_footer'] == "1") {
	$enable_footer = 'true';
	}else{	
	$enable_footer_class = "no-footer";	
	}
	
	
	if ( $post_id && ( rwmb_meta( 'santos_enable_footer' ) == 'false' ) ) {
		$enable_footer = 'false';
		$enable_footer_class = "no-footer";
	}
	
	$enable_footer = rwmb_meta( 'santos_enable_footer',$args = array(),$post_id ) == 'true' ? rwmb_meta( 'santos_enable_footer',$args = array(),$post_id ) : $enable_footer;
		

		
	if ( santos_get_post_id() && class_exists( 'RWMB_Field' ) ) {

		$footer_layout = rwmb_meta( 'santos_footer_layout',$args = array(),$post_id ) ? rwmb_meta( 'santos_footer_layout',$args = array(),$post_id ) : $footer_layout;
	}

	
	
	include( get_template_directory() . '/includes/footer/'.esc_attr($footer_layout).'.php' ); 
	
	
	
}



#-----------------------------------------------------------------#
# SubFooter
#-----------------------------------------------------------------#
if (!function_exists('santos_sub_footer')) {
function santos_sub_footer() {
	
	
	$santos_options = get_option('santos_options');
	$post_id = santos_get_post_id();
	$enable_subfooter = false;
	
	if ( $post_id && ( rwmb_meta( 'santos_enable_subfooter' ) == 'false' ) ) {
			return false;
	}
	
	if (isset($santos_options['enable_sub_footer']) && $santos_options['enable_sub_footer'] == "1") {
	$enable_subfooter = true;
	}
	
	$enable_subfooter = rwmb_meta( 'santos_enable_subfooter',$args = array(),$post_id ) == true ? rwmb_meta( 'santos_enable_subfooter',$args = array(),$post_id ) : $enable_subfooter;
		

	
	if ($enable_subfooter == true) {
		
		
	$footer_scheme = isset($santos_options['footer_color_scheme']) ? $santos_options['footer_color_scheme'] : 'darckBg';

	if ( santos_get_post_id() && class_exists( 'RWMB_Field' ) ) {
	
	$footer_scheme = rwmb_meta( 'santos_footer_color_scheme',$args = array(),$post_id ) ? rwmb_meta( 'santos_footer_color_scheme',$args = array(),$post_id ) : $footer_scheme;
	}		
		
		
		?>
		
	 <div class="copyrights">
            <div class="container">

                <div class="col-md-12">
				
				<?php
				if($footer_scheme == 'lightBg'){ ?>
						<div class="line"></div>
				<?php } ?>	
		
		
				
				<?php
				
				if (isset($santos_options['enable_back_top']) && $santos_options['enable_back_top'] == "1") {	
				echo ' <a href="#" id="back-to-top" title="Back to top"><i class="ion-chevron-up"></i> </a>';
				}	
				
				
				santos_copyrights();
				?>
                   
                </div>
            </div>
        </div>

      <?php get_template_part('cookie', 'banner') ?>
		<?php	
	
		

		}
			
	}
}


#-----------------------------------------------------------------#
# Copyrights
#-----------------------------------------------------------------#
if (!function_exists('santos_copyrights')) {
function santos_copyrights() {
	
	$santos_options = get_option('santos_options');
			
			if (isset($santos_options['footer_copyright']) && $santos_options['footer_copyright'] != ""){
				echo '<p>'. do_shortcode(shortcode_unautop($santos_options['footer_copyright'])) .'</p>'; 
			} else{ 
				echo '<p>'.esc_html__('Copyright', 'santos') .' &copy;'. date("Y") .' '. get_bloginfo('name') .' '. esc_html__('All Rights Reserved', 'santos'). '</p>';
			} 

			
	}
}






#-----------------------------------------------------------------#
# Footer Social
#-----------------------------------------------------------------#
if (!function_exists('santos_footer_social')) {
function santos_footer_social() {
	
	$social_output = '';
	$santos_options = get_option('santos_options');
	
	if (isset($santos_options['use_footer_social']) && $santos_options['use_footer_social'] == "1") {	
	if (isset($santos_options['added_footer_social_network']) && $santos_options['added_footer_social_network'] != "") {

	$added_footer_social_network = $santos_options['added_footer_social_network'];

	$social_output .= '<ul class="social-footer pull-right"> ';
	foreach($added_footer_social_network as $social_icon){

	if (isset($santos_options[$social_icon.'-url']) && $santos_options[$social_icon.'-url'] != "") {    
	$social_url = $santos_options[$social_icon.'-url'];   
	}else{ $social_url = '#';}

	$social_output .= '<li><a href="'. esc_url($social_url).'" target="_blank" title="'.$social_icon.'" ><i class="ion-social-'.$social_icon.'"></i></a></li>';

	}

	$social_output .= '</ul> ';

	}
	}

	echo do_shortcode($social_output);
			
	}
}



/* ---------------------------------------------------------------------------
 * Scripts | Custom JS
* --------------------------------------------------------------------------- */
if (!function_exists('santos_options_custom_script')) {
function santos_options_custom_script() {
	
	/*add_ajax_library*/
    $ajax_js= 'var ajaxurl = "' . admin_url('admin-ajax.php') . '"';
	wp_add_inline_script( 'santos-script', $ajax_js );
  

	$custom_js='';
	$santos_options = get_option('santos_options');
	if(!empty($santos_options["custom-js"])){
		$custom_js = $santos_options['custom-js'];
	} 
	 
	if ($custom_js !== '') {
		wp_add_inline_script( 'santos-script', $custom_js );
	}
}
}
add_action( 'wp_enqueue_scripts', 'santos_options_custom_script' );





#-----------------------------------------------------------------#
# Moving the Comment Text Field to Bottom
#-----------------------------------------------------------------#
function santos_move_comment_field_to_bottom( $fields ) {
$comment_field = $fields['comment'];
unset( $fields['comment'] );
$fields['comment'] = $comment_field;
return $fields;
}
add_filter( 'comment_form_fields', 'santos_move_comment_field_to_bottom' );



/**
* Function that transforms hex color to rgb color
* @param $hex string original hex string
* @return array array containing three elements (r, g, b)
*/
if (!function_exists('santos_hex2rgb')) {
	function santos_hex2rgb($hex) {
	$hex = str_replace("#", "", $hex);
	if(strlen($hex) == 3) {
	$r = hexdec(substr($hex,0,1).substr($hex,0,1));
	$g = hexdec(substr($hex,1,1).substr($hex,1,1));
	$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
	$r = hexdec(substr($hex,0,2));
	$g = hexdec(substr($hex,2,2));
	$b = hexdec(substr($hex,4,2));
	}
	$rgb = array($r, $g, $b);
	return $rgb; 
	/* returns an array with the rgb values */
	}
}



function santos_let_to_num( $size ) {
				$l   = substr( $size, - 1 );
				$ret = substr( $size, 0, - 1 );

				switch ( strtoupper( $l ) ) {
					case 'P':
						$ret *= 1024;
					case 'T':
						$ret *= 1024;
					case 'G':
						$ret *= 1024;
					case 'M':
						$ret *= 1024;
					case 'K':
						$ret *= 1024;
				}

				return $ret;
}

#-----------------------------------------------------------------#
# Portfolio Related Posts
#-----------------------------------------------------------------#
if (!function_exists('santos_portfolio_related_posts')) {
function santos_portfolio_related_posts() {
global $post;
$cats  =  wp_get_object_terms( $post->ID, 'santos-portfolio-category' );
if ( $cats ) {
			$catcount = count( $cats );
			for ( $i = 0; $i < $catcount; $i++ ) {
				$catSlugs[$i] = $cats[$i]->slug;
			}
			$rel_query = array(
				'post__not_in' => array( $post->ID ),
				'showposts'=>3,
				'ignore_sticky_posts'=>1,
				'post_type' => 'santos-portfolio',
			);
			$rel_query['tax_query'] = array(
					array(
						'taxonomy' => 'santos-portfolio-category',
						'field' => 'slug',
						'terms' => $catSlugs
					)
				);
				
				$output = '';
				
	
				$related_items = new WP_Query( $rel_query );
			    if ( $related_items->have_posts() ) {
				$output .= '<!-- related section -->
				<div class="greySection relatedDiv">

				<div class="text-center">
				<h4>'.esc_html__('Related Work','santos').'</h4>
				</div>
				<div class="h-50"></div>
				<div class="container">';
			
				while ( $related_items->have_posts() ) {
					global $post;
					$related_items->the_post();
					if ( has_post_thumbnail() ) {
              
                      $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "santos_default" );
 
					$output .= ' <!-- blog item -->
					<div class="col-md-4 col-sm-6">
					<!-- recent item -->
						<div class="recentDiv">
							<a href="'.get_permalink().'">
								<img src="'.$imgsrc[0].'" alt="" class="img-responsive" />
								<div class="recentTitleDiv">
									<h3>'. get_the_title().'</h3>
									<span>logo / design</span>
								</div>
							</a>
						</div>
					<!-- / recent item -->
					</div>
					<!-- / blog item -->';
					}
					
					}
				$output .= '   <div class="clearfix"></div>
				</div></div>
				<!-- / related section -->';
				wp_reset_postdata();
				
				}
				
				echo do_shortcode($output);
	}
}
}


#-----------------------------------------------------------------#
# Blog Related Posts
#-----------------------------------------------------------------#
if (!function_exists('santos_blog_related_posts')) {
function santos_blog_related_posts($postID) {
global $post;
$santos_tags = wp_get_post_tags($postID);
$santos_post_tag_array = array();

for($i=0 ; $i < sizeof($santos_tags); $i++){
$santos_post_tag_array[] = $santos_tags[$i]->term_id;
}

if ($santos_tags) {

  $santos_args=array(
    'tag__in' => $santos_post_tag_array,
    'post__not_in' => array($postID),
    'showposts'=>4,
    'ignore_sticky_posts'=>1
   );
   
	
   
  $santos_my_query = new WP_Query($santos_args);
  if( $santos_my_query->have_posts() ) { ?>
  

	<!-- related section -->
    <div class="relatedDiv mt-30">
        <div class="text-center">
            <h4 style="color:#FFF;"><?php echo esc_html_e('Può interessarti anche','santos');?> </h4>
        </div>
        <div class="h-50"></div>
        <div class="_container">

	 <?php
    while ($santos_my_query->have_posts()) : $santos_my_query->the_post(); ?>
    <?php 
	
	$imgsrc = '';
	$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "large" ); 
	?>
	
			<!-- blog item -->
            <div class="col-lg-3 col-md-6 col-sm-6 related-post-single">
                <div class="newsBox">
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php echo esc_url($imgsrc[0]); ?>" alt="" class="img-responsive" />
                    </a>
                    <div class="contentBlogDiv">
                        <a class="newsDate"><?php echo get_the_date(); ?></a>
                        <a href="<?php the_permalink(); ?>">
                            <h4><?php the_title(); ?></h4>
                        </a>

                    </div>
                </div>
            </div>
            <!-- / blog item -->
			

      <?php


    endwhile;
   wp_reset_postdata(); 
   ?>
    
	             <div class="clearfix"></div>
        </div>

    </div>
    <!-- / related section -->
  <?php
   }
  }
 }
} 
