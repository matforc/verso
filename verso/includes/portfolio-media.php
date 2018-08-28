<?php 
/* Portfolio Media */

  $media_type = rwmb_meta('santos_project_feature_type') ? rwmb_meta('santos_project_feature_type') : 'image';
  
  $project_gallery = '';
  $project_gallery = rwmb_meta('santos_project_gallery', 'type=image_advanced&size=full' );

  $video_type = rwmb_meta('santos_project_video_type')? rwmb_meta('santos_project_video_type') : 'youtube';
  $video_id = rwmb_meta('santos_project_video_id') ? rwmb_meta('santos_project_video_id') : '';
  
  
  	if($media_type == 'image'){

		if ( has_post_thumbnail() ) {

			the_post_thumbnail('full' , array('class' => 'img-responsive img-rounded', 'title' => 'Feature image'));

		}

	}elseif ($media_type == 'gallery'){
				
?>

			<div class="owl-carousel owl-theme single-portfolio">
                    <!-- single-portfolio items -->
					
					<?php
									
					foreach($project_gallery as $project_img){
					echo ' <div class="SliderItem">
							<img src="'. esc_url($project_img["url"]) .'" class="img-rounded img-responsive"  alt="" />
						 </div>';
					}
					

				   ?>   

                    <!-- / single-portfolio items -->


             </div>
				

	<?php 
		}elseif ($media_type == 'video'){
			
			
			echo '<div class="fitvideo">';

			if($video_type == 'vimeo'){

        	echo '<iframe src="https://player.vimeo.com/video/'.$video_id.'?badge=0" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>'; 

			}

			if($video_type == 'youtube'){

        	echo '<iframe width="500px" height="400px" src="https://www.youtube.com/embed/'.$video_id.'" frameborder="0" allowfullscreen></iframe>';

			}

			echo '</div>';
			
			
		}
   