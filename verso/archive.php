<?php get_header(); ?>
<!--Archive -->


<?php 
$santos_options = get_option('santos_options'); 
$titlebar_style = 'default'; 
if (isset($santos_options['blog_titlebar_style']) && $santos_options['blog_titlebar_style'] !='') {
$titlebar_style = $santos_options['blog_titlebar_style']; 
}
?>

<!-- title Hed -->
<?php
if($titlebar_style == 'custom_img' )
{
	
	$titlebar_bg_color = $santos_options['titlebar_extend_bg_color']; 
	$titlebar_bg_img = $santos_options['blog_titlebar_bg_img']['url']; 
	
	echo '<div class="titleHed titleHedBgImg background parallax" style="background-color:'. esc_attr($titlebar_bg_color).'; background-image:url('. esc_url($titlebar_bg_img).');" data-img-width="1600" data-img-height="1064" data-diff="100">';
	echo ' <div class="titleHedOverlay"></div>';
	

	
}else{
	
	echo '<div class="titleHed backgrondGrey padding-bottom-0 background parallax" data-img-width="1600" data-img-height="1064" data-diff="100">';
}
?>
	
   
        <div class="container">
		<?php	the_archive_title( '<h1>', '</h1>' );	?>
            <div class="h-20"></div>
           	<div class="breadcrumbDiv">
					<?php //santos_breadcrumbs();	?>
			</div>	
        </div>
    </div>
    <!-- / Title head -->
	
	
 <!-- blog container -->
    <div id="blogs" class="padding-100 greySection">
	
	
			<?php
				$santos_options = get_option('santos_options');  
				$santos_items = get_option( 'posts_per_page'); 
				
				if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
				elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
				else { $paged = 1; }

				$santos_main_class ="col-md-8";	
				$blog_item_class ="col-md-6";	
				if (isset($santos_options['enable_fullwidth_blog']) && $santos_options['enable_fullwidth_blog'] == "1") {
				$santos_main_class = "col-md-12";
				$blog_item_class ="col-md-4";
				}
				
				$blog_layout = 'classic';
				if (isset($santos_options['archive_layout'])) {
				$blog_layout = $santos_options['archive_layout'];
				}
				
		
			?>
	
        <div class="container">
            <div class="<?php echo esc_attr($santos_main_class); ?>">
			
			
			 <?php
			 if($blog_layout == 'masonry' ){
			  echo '<div class="blog_container  clearfix">';
			 }
	   
				if(have_posts()) {
					
				while( have_posts()) : the_post();  
				
				
				?>
				
				  <div <?php if($blog_layout == 'masonry'){ echo 'class="'. esc_attr($blog_item_class).' col-sm-6"'; } ?> data-aos="fade-up">
                   
				
				
				<?php
						get_template_part( 'includes/post-format/content', get_post_format() ); 
				?>
				
			        
                </div>
                <!-- / blog item -->
				
				<?php endwhile;  ?>
				
				
					
				<?php
				
				if($blog_layout == 'masonry' ){
				echo '</div>';
				}
			 
				}else{ ?>
                    <h2><?php esc_html_e('No Posts Found', 'santos') ?></h2>
                    <?php
                } 

				
				
						
				if( get_next_posts_link() || get_previous_posts_link() ) { 
				echo '<nav class="pag-archive" aria-label="...">
                    <ul class="pager">
                        <li class="previous disabled">'. esc_url(get_previous_posts_link('&larr; Older')).'</li>
                        <li class="next">'. esc_url(get_next_posts_link('Newer &rarr;','')).'</li>
                    </ul>
                </nav>';
				}

              ?> 

            </div>
			
			
			 <?php if (isset($santos_options['enable_fullwidth_blog']) && $santos_options['enable_fullwidth_blog'] != "1") { ?>
				 
				  <?php get_sidebar(); ?>
				  			   
			<?php } ?>
				  
				  
           

        </div>
    </div>
    <!-- / blog container -->
	


<?php get_footer(); ?>