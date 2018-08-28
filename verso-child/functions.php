<?php


/* enqueue the child theme stylesheet */

function santos_theme_child_enqueue_styles() {

    $parent_style = 'santos-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css', array( 'bootstrap','santos-bootsnav' ) );
   
	wp_enqueue_style( 'santos-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );

	wp_enqueue_style( 'intro',
		get_stylesheet_directory_uri() . '/intro/intro-css/intro.css',
		array( $parent_style ),
		wp_get_theme()->get('Version')
	);

}


function santos_theme_child_enqueue_scripts() {
	//VENDOR SCRIPTS
	//wp_enqueue_script( 'inView', get_stylesheet_directory_uri() . '/vendors/inView.js', array( 'jquery' ), null, true );

	wp_enqueue_script('tweenmax', get_stylesheet_directory_uri() . '/intro/intro-js/TweenMax.min.js', 'jquery', '1.0', true);
	wp_enqueue_script('drawSvg', get_stylesheet_directory_uri() . '/intro/intro-js/DrawSVGPlugin.min.js', 'tweenmax', '1.0', true);

	wp_enqueue_script('intro', get_stylesheet_directory_uri() . '/intro/intro-js/intro.js', 'drawSvg', '1.0', true);

	wp_enqueue_script('child-script', get_stylesheet_directory_uri() . '/scripts.js', 'jquery', '1.0', true);


	wp_localize_script('child-script', 'WPURLS', array( 'siteurl' => get_option('siteurl') ));

}
add_action( 'wp_enqueue_scripts', 'santos_theme_child_enqueue_styles');

add_action( 'wp_enqueue_scripts', 'santos_theme_child_enqueue_scripts', 99);



/* Change color to editor */
add_editor_style();

/* Change the archive title if the category is prodotti*/
add_filter( 'get_the_archive_title', function ( $title ) {

	if( is_category('prodotti') ) {

		$title = 'Tutti i prodotti';

	}

	return $title;

});
/* Related post carousel shortcode */
function andrew_loop_shortcode( $atts ) {
	 $sc = shortcode_atts( array(
		'slide_items' => 3
	), $atts ) ;

	$output = '<div class="owl-carousel owl-theme showcase santos_showcase_carousel" data-slide-items="'.$sc[$slide_items].'">';

	$tags = wp_get_post_tags($post->ID);

	if ($tags) {
		$first_tag = $tags[0]->term_id;
		$args=array(
			'tag__in' => array($first_tag),
			'post__not_in' => array($post->ID),
			'posts_per_page'=>-1,
		);
		$my_query = new WP_Query($args);
		if( $my_query->have_posts() ) {
			while ($my_query->have_posts()) : $my_query->the_post(); ?>

				<?php

				/* grab the url for the full size featured image */
				$featured_img_url = get_the_post_thumbnail_url('full');
				$pl = the_permalink();

				?>

				$output .= ' <div class="recentDiv"><a href="'
				.esc_url($pl).
				'" rel="bookmark" title="'
				.the_title_attribute().'
					"><img src="'.$featured_img_url.'" alt="" class="img-responsive" />
					</a>
				</div>';


				<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>



				<?php
			endwhile;
		}
		wp_reset_query();
	}

	$output .= '</div>';
	return $output;
}
add_shortcode('andrewloop', 'andrew_loop_shortcode');




//add post category filter by name in Rest Api
add_filter( "rest_post_query", function( $args, $request){
	if ( isset( $request['category_name']) && !empty($request['category_name'] ) ) {
		$args['category_name'] = $request['category_name'];
	}
	return $args;
}, 10, 2);

add_filter( "rest_post_collection_params", function($query_params, $post_type){
	$query_params[ 'category_name' ] = array(
		'description' => __( 'Category name.' ),
		'type'        => 'string',
		'readonly'    => true,
	);
	return $query_params;
}, 10, 2);


//Admin page custom CSS
add_action('admin_head', 'admin_custom_css');

function admin_custom_css() {
	echo '<style>
    #menu-posts-santos-portfolio, #menu-posts-santos-slider {
    display: none;
    }
  </style>';
}

//Eliminare la parola prima del titolo archivio categorie e tag

function my_theme_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	}

	return $title;
}

add_filter( 'get_the_archive_title', 'my_theme_archive_title' );

//Display featured image shortcode
add_shortcode('thumbnail', 'thumbnail_in_content');

function thumbnail_in_content($atts) {
	global $post;

	return get_the_post_thumbnail($post->ID);
}

//Prodotti list
function prodotti_list_function() {
	query_posts(array('post_type' => 'prodotti_verso', 'orderby' => 'date', 'order' => 'DESC' , 'show_posts' => -1));
	if (have_posts()) :
		while (have_posts()) : the_post();
			$return_string = '<a href="'.get_permalink().'">'.get_the_title().'</a>';
		endwhile;
	endif;
	wp_reset_query();
	return $return_string;
}
function register_shortcodes(){
	add_shortcode('prodotti_list', 'prodotti_list_function');
}
add_action( 'init', 'register_shortcodes');