<?php get_header(); ?>
<!--Archive Portfolio -->

    <!-- Title head -->
    <div class="titleHed">
        <div class="container">
           <?php   the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
            <div class="h-20"></div>
           <div class="breadcrumbDiv">
				<?php santos_breadcrumbs();	?>
			</div>	
        </div>
    </div>
    <!-- / Title head -->
	
	

    <!-- projects section -->
    <div id="projects" class="backgrondGrey">
        <div data-aos="fade-up">
            <!-- main container -->
            <div class="main-container pt-30 clearfix">
			
			

			
			
			
			
            </div>
            <!-- end main container -->
        </div>
        <div class="h-50"></div>
    </div>
    <!-- / projects section -->


	

    <div class="padding-tb-30 clearfix">
        <div class="container-fluid">
		
		
		<?php
				$santos_options = get_option('santos_options');  
				$santos_items = get_option( 'posts_per_page'); 
				
				if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
				elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
				else { $paged = 1; }

				$santos_main_class ="col-md-9";	
				if (isset($santos_options['enable_fullwidth_blog']) && $santos_options['enable_fullwidth_blog'] == "1") {
				$santos_main_class = "col-md-12";
				}
		
			?>
			
			

            <div class="<?php echo esc_attr($santos_main_class); ?>">
                <div class="blog_container">
				
				 <?php
	   
			
				if(have_posts()) : while( have_posts()) : the_post();  
				

				
				?>
				
					
					
					
			<?php endwhile;  ?>
			
			</div>
			
				 <div class="clearfix"></div>
			
 
                       
                    
			<div class="col-md-12">		
			<div class="pagination">
			<div class="nav-previous alignleft"><?php next_posts_link( 'Older posts' ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div>
			</div>
			</div>	 
				
				<?php	
				
				
			
			
			
				else : ?>
                    <h2><?php esc_html_e('No Posts Found', 'santos') ?></h2>
                    <?php
                endif; 

				
			
				?>
			
			
               
            </div>
			
			
			 <?php if (isset($santos_options['enable_fullwidth_blog']) && $santos_options['enable_fullwidth_blog'] != "1") { ?>
				 
				  <?php get_sidebar(); ?>
				  			   
				  <?php } ?>
				  
				  
				  
 
        </div>
    </div>

<?php get_footer(); ?>