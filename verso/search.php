<?php get_header(); ?>


<!--search -->

	<div class="titleHed greySection">
	 <div class="container">
	 
	 <div class="text-center blogTitle">
	 
		<h1><?php  $title	= esc_html__('Search', 'santos'); 	echo esc_attr($title);	?></h1>
		
		<div class="breadcrumbDiv">
					<?php santos_breadcrumbs();	?>
			</div>	
	  </div>	
    </div>
 </div>	
 
	
		
	  <div id="blogs" class="padding-100 greySection">
        <div class="container">
		
		
		
			
			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<div class="clearfix"></div>
			

				
			
               
				
			 <div class="col-md-8 search-main" >
			  <div class="blog_container">
			
			 
			 <?php 
			 if ( have_posts() ) : 
			 ?>
			 
			 <div class="searchResult">
			 
			<?php while ( have_posts() ) : the_post(); ?>
			 
			 
			  
                                    <div class="newsBox">
									
									<?php if ( has_post_thumbnail() ) { ?>
									<a class="searchResultImg" href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail('full', array( 'class' => 'img-responsive' )); ?>
									</a>
									<?php } ?>
									

                                    <div class="searchResultPost contentBlogDiv">
                                                <a class="newsDate"><?php echo get_the_date(); ?></a>
												<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>  
                                               
												 <p><?php  the_excerpt(); ?></p>
                                    </div>
                                    </div>
									

		
				<?php endwhile;  ?>
				
				</div>
					
				<?php else: ?>
				<div class="row"> 
				<div class="col-md-12">
				<h2><span class="searchOops"><?php esc_html_e( "Oops!","santos"); ?></span><?php esc_html_e( "Couldn't find what you're looking for!","santos"); ?> </h2>
				<p><?php esc_html_e( 'Try to search again','santos'); ?></p>
			
				<?php get_search_form(); ?>
				
				</div></div>
				<?php
				endif;
				
				
			if( get_next_posts_link() || get_previous_posts_link() ) { 
				echo '<div class="pagination classic" id="pagination" data-is-text="'.__("All items loaded", 'santos').'">
				      <div class="prev">'.get_previous_posts_link('&laquo; Newer Entries').'</div>
				      <div class="next">'.get_next_posts_link('Older Posts &raquo;','').'</div>
			          </div>';
			
	        }
				?>
                </div></div>  
              
				
			
				
              	 <?php get_sidebar(); ?>
              	
      
           </div>  
             
     </div>
    </div>



<?php get_footer(); ?>