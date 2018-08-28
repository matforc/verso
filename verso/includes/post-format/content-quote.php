<?php 

$sticky_class = "";
if(is_sticky()){
$sticky_class = "sticky_post";	
}


$imgsrc = '';
if ( has_post_thumbnail() ) { 
$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "full" ); 
echo '<div class="newsBox quoteBox quoteBackgound '.$sticky_class.'" style="background:url('. $imgsrc[0].');">';
} else{
echo '<div class="newsBox quoteBox colored '.$sticky_class.'">';	
}


		 

	echo '<div class="contentBlogDiv">';
                            
                                
								
							if ( class_exists( 'RWMB_Field' ) ){ 
							  
							  if ( rwmb_meta('santos_post_quote') != ''){
							  echo '<h4><a href="'. get_the_permalink().'">'. rwmb_meta( 'santos_post_quote' ) .'</a></h4>';   
							  }       

							} 
								
	

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

			echo '</div> </div>';
			
			if ( has_post_thumbnail() ) { 
            echo '<div class="bolgOverlay"></div>';
			}
		echo '</div>';
