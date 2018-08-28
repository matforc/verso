<?php get_header(); ?>
<!-- titlebar -->
<?php santos_titlebar(); ?>
<!--single Portfolio -->

<?php 
$santos_options = get_option('santos_options'); 
$cats = '';

$item_categories = get_the_terms( $post->ID, 'santos-portfolio-category' );

if($item_categories){
$i=0;

foreach ($item_categories as $item){
	
	if($i!=0){ 
	$cats .= '<span class="cat_slash">,</span> ';
	}
	$cats .= $item->name;
	$i++;
	}

}

 ?>
	 

    <!-- portfolio container -->
    <div id="portfolio" class="padding-100">
	
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
	
	<?php
	$disable_feature = rwmb_meta( 'santos_project_disable_feature')? rwmb_meta( 'santos_project_disable_feature' ) : 'false'; 
	$project_info_position = rwmb_meta( 'santos_project_info_position')? rwmb_meta( 'santos_project_info_position' ) : 'above'; 
	?>
	
	
		<?php
		if($disable_feature != 'true'){
		?>
        <div class="container">
           <div class="col-md-10 col-md-offset-1">
		   
		<?php  include( get_template_directory() . '/includes/portfolio-media.php'); ?>

				<div class="h-50"></div>
               
          </div> </div>     
               
        <?php
		}
		
		
		
	if($project_info_position != 'disable'){

			$project_date = rwmb_meta( 'santos_project_date' ) ? rwmb_meta( 'santos_project_date' ) : '';
			$client_name = rwmb_meta( 'santos_project_client' ) ? rwmb_meta( 'santos_project_client' ) : '';
			$project_url = rwmb_meta( 'santos_project_url' ) ? rwmb_meta( 'santos_project_url' ) : '';
			$project_intro = rwmb_meta( 'santos_project_intro' ) ? rwmb_meta( 'santos_project_intro' ) : '';
			$project_description = rwmb_meta( 'santos_project_description' ) ? rwmb_meta( 'santos_project_description' ) : '';

			
			
			if($project_description !=''){   ?> 
				<div class="container">
					<div class="col-md-10 col-md-offset-1">
                    <div class="s-text">
                        <?php echo esc_attr($project_intro); ?>
                    </div>
				 </div> </div>
				 
				<div class="h-50"></div>
			<?php }	?>
                   
					
					
					<?php
					if($project_info_position == 'below'){	
					the_content();
					echo '<div class="h-50"></div>';
					}
					?>
					
			
		<div class="container">
           <div class="col-md-10 col-md-offset-1">

                <!-- post text -->
                <div class="project_info">
				

                    <div class="row">
                        <div class="col-md-4">
                            <div class="portfolioInfo">
							<?php
							if($client_name !=''){ ?>
                                <p><strong><?php esc_attr_e('Client','santos'); ?> : </strong> <?php echo esc_attr($client_name); ?></p>
							<?php }	
							if($project_date !=''){ ?>
                                <p><strong><?php esc_attr_e('Date','santos'); ?> : </strong> <?php echo esc_attr(date( 'd F, Y', strtotime( $project_date ) ));  ?> </p>
							<?php }	
							if($project_url !=''){ ?>	
                                <p><strong><?php esc_attr_e('Link','santos'); ?> : </strong> <a href="<?php echo esc_attr($project_url); ?>" target="_blank"><?php esc_attr_e('Project URL','santos'); ?></a></p>
                            <?php }	
							if($item_categories !=''){ ?>   
							   <p><strong><?php esc_attr_e('Type','santos'); ?> : </strong> <?php echo do_shortcode($cats); ?></p>
							<?php }	?>
							 
                            </div>
                        </div>
						
						
                        <div class="col-md-8">
						
						 <?php 
						 if($project_description !=''){ ?> 
							
                            <p>
							
							 <?php echo esc_attr($project_description); ?>
                            </p>
						<?php }	?>
						
                        </div>
                    </div>




                </div>
                <div class="h-50"></div>
               
                <!-- / post text -->
			</div> </div>	
		<?php 
		
		if($project_info_position == 'above'){	
		the_content();
		}
		
	}else{
		
		the_content();
		
	} 
		
		?>
		
		
		<div class="container">
           <div class="col-md-10 col-md-offset-1">

                <!-- share Div -->
              <?php
			  
			 
			if (isset($santos_options[ 'enable_portfolio_share']) && $santos_options[ 'enable_portfolio_share']=="1" ) { 
				
				 if( class_exists( 'Santos_Core_Plugin' ) ) {
						
						santos_single_sharing_buttons(); 
						
				}
			  }
				?>			
                <!-- / share Div -->



            </div> 
        </div>  
		
		</div> <!-- / post ID -->
		
		 <?php endwhile; endif; ?>
		 
    </div>
    <!-- / protfolio container -->
	
	
	
	 <!-- related section -->
	<?php 
		if (isset($santos_options[ 'enable_portfolio_related']) && $santos_options[ 'enable_portfolio_related']=="1" ) { 
		santos_portfolio_related_posts($post->ID) ;
		} 
	?>
		
<!-- / related section -->

		
<?php get_footer(); ?>	