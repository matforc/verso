<?php 

$sticky_class = "";
if(is_sticky()){
$sticky_class = "sticky_post";	
}

echo '<div class="newsBox '.$sticky_class.'"><div class="videoWrapper">';

if ( class_exists( 'RWMB_Field' ) ){ 
  
  if ( rwmb_meta('santos_post_video') != ''){
  echo rwmb_meta( 'santos_post_video' ) ;   
  }       

} 
		 

 

echo '</div><div class="contentBlogDiv">
	<a class="newsDate">'. get_the_date() .'</a>
	
	
	<h4><a href="'. get_the_permalink().'">'. get_the_title().'</a></h4>
	
	<p>'. get_the_excerpt().'</p>

	<hr />';
	
	
	
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
		<span> ' .esc_html__("in", "santos").' <a href="'. $cat_url.'">'. $cat_slug.' </a> </span>';

		echo '</div>
	</div></div>';
