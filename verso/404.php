<?php get_header(); ?>

<!--404 -->

	<div class="titleHed background parallax" data-img-width="1600" data-img-height="1064" data-diff="100">
	  <div class="container padding-100">
			<h1><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'santos' ); ?></h1>

			<div class="breadcrumbDiv">
					<?php santos_breadcrumbs();	?>
			</div>	
		</div>	
    </div>
	
	
	
	 <div class="page-wrapper padding-wrap-bottom">
	
        <div class="container layout-fullwidth text-center">
			
			
			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

			 <div class="col-md-12 main-404">
			 
			 
			<p><?php esc_html_e( 'We are sorry, the page you are looking for does not exist.', 'santos' ); ?></p> 
			<p><?php esc_html_e( 'You can try our search or back to Homepage.', 'santos' ); ?></p> 
			<?php get_search_form(); ?>
						
			
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-blue 404"><?php esc_html_e( 'Go Home', 'santos' ); ?></a>
           </div>  
              
				
			
			
             
             
      
           </div>  
             
     </div>
    </div>



<?php get_footer(); ?>