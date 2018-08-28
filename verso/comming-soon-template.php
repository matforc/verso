<?php get_header(); 

/*
Template Name: Comming Soon Template
*/

?>


<!--Page -->
	<div class="page-content">
	
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			
			<div class="comming_soon_container">
			 
<?php 
$santos_imgpost_url ='';
if ( has_post_thumbnail()) {
  $santos_imgpost = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "full" );
  $santos_imgpost_url = $santos_imgpost[0];
 }
?> 
               

                    
                <div class="post">
					
					<?php if ( has_post_thumbnail()) { ?>
                    	<div class="img-body">
                    	<img src="<?php echo esc_url($santos_imgpost_url); ?>" alt="" class="img-responsive" />
                            
                        </div>
						<?php } ?>
                       
				<?php the_content(); ?>
				
					<div class="clearfix"></div>
					

                	 <?php endwhile; endif; ?>
                    
    
                </div>      
                  

				</div><!--row--> 
           </div><!--post-->
    </div><!--container -->


<?php get_footer(); ?>