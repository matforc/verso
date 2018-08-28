<?php
$sticky_class = "";
if(is_sticky()){
$sticky_class = "sticky_post";	
}

echo '<div class="newsBox '.$sticky_class.'">';
	$imgsrc = '';
	if ( has_post_thumbnail() ) { 
	$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "full" );
		$thumbnail_id = get_post_thumbnail_id( $post->ID );
		$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
		echo '<div class="image-archive-wrapper"><a href="'. get_the_permalink().'"><img src="'. $imgsrc[0].' " alt="'. $alt .'" class="img-responsive" /></a></div>';
	}

echo '
<div class="contentBlogDiv">
	<a class="newsDate">'. get_the_date() .'</a>
	
	<h3 class="post_title"><a href="'. get_the_permalink().'">'. get_the_title().'</a></h3>
	
	<p class="excerpt-archive">'. get_the_excerpt().'</p>';

	$item_categories = get_the_category( $post->ID , 'category');
	$cat_slug = $cat_url = '';
 		if(is_object($item_categories) || is_array($item_categories)){
		foreach ($item_categories as $cat)
			{
			$cat_slug .= $cat->name .' ' ;
			$cat_url   = get_category_link( $cat->term_id ) ;
			break;
			}
		}
	echo '<div class="personDiv">
		'. get_avatar( get_the_author_meta( 'user_email' ), 30 ).'
		<span>by '.get_the_author_meta('display_name').'</span>
		<span> ' .esc_html__("in", "santos").' <a href="'. $cat_url.'">'. $cat_slug.' </a></span>';

	echo '</div>
			</div>
					</div><!-- END DIV WRAPPER -->';
