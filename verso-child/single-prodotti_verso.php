<?php get_header(); ?>
<!-- titlebar -->
<?php santos_titlebar(); ?>

<!--single -->
<?php
$santos_options = get_option('santos_options');
$post_layout = 'fullwidth';
if (isset($santos_options['post_layout'])) {
	$post_layout = $santos_options['post_layout'];
}

$titlebar_style = isset($santos_options['default_titlebar_style']) ? $santos_options['default_titlebar_style'] : 'minimal';
$titlebar_style = rwmb_meta( 'santos_titlebar_style') ? rwmb_meta( 'santos_titlebar_style') : $titlebar_style ;

?>
<!-- blog section -->
<div id="blogs" class="item-fadeIn">
	<div class="container layout-<?php echo esc_attr($post_layout); ?>">


		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


		<div class="<?php if ( $post_layout !='fullwidth' ) { ?> col-md-8 post-content <?php }else{?> col-md-10 col-md-offset-1 <?php } ?>">
			<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

				<?php
				$disable_feature = rwmb_meta( 'santos_post_disable_feature')? rwmb_meta( 'santos_post_disable_feature' ) : 'false';
				if($disable_feature == 'false'){

					$post_format = get_post_format();

					switch ($post_format) {
						case "audio":
							echo '<div class="newsBox">'. rwmb_meta( 'santos_post_audio' ).'</div>' ;
							break;
						case "video":
							echo '<div class="newsBox">'. rwmb_meta( 'santos_post_video' ) .'</div>' ;
							break;
						case "quote":
							echo '<div class="newsBox quoteBox single colored"><i class="ion-quote"></i><div class="contentBlogDiv"><h4>'. rwmb_meta( 'santos_post_quote' ) .'</h4></div></div>';
							break;
						default:
							$header_bg_images = rwmb_meta( 'santos_titlebar_custom_image', 'type=image&size=full');
							the_post_thumbnail('post-thumbnail', array('class' => 'img-responsive img-rounded featured-img', 'title' => 'Feature image'));
					}


					echo '<div class="h-50"></div>';

				}
				?>

				<?php the_content(); ?>
				<div class="clearfix"></div>
			</article>

			<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'santos' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'santos' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

			?>

			<!-- related section -->
			<?php

			if (isset($santos_options[ 'enable_post_related']) && $santos_options[ 'enable_post_related']=="1" ) {
				santos_blog_related_posts($post->ID) ;
			}

			?>

			<!-- / related section -->





			<?php the_tags( '<div class="tags"><p><strong>' . esc_html__( 'Tags', 'santos' ).' :</strong></p> <ul class="post-tags clearlist rightList space20" ><li>', '</li><li>', '</li></ul></div>' ); ?>
			<?php
			$categories = get_the_category();
			$separator = ' ';
			$output = '';
			if ( ! empty( $categories ) ) {?>
				<div class="categories">
					<p><strong>Categorie:</strong></p>
					<ul class="post-tags clearlist rightList space20" >


						<?php
						foreach( $categories as $category ) {
							$output .= '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '" type="' . $category->slug . '" alt="' . esc_attr( sprintf( __( 'Guarda tutti i post in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a></li>' . $separator;
						}
						echo trim( $output, $separator );
						?>
					</ul>
				</div>
			<?php } ?>

			<?php

			if (isset($santos_options[ 'enable_post_share']) && $santos_options[ 'enable_post_share']=="1" ) {
				if( class_exists( 'Santos_Core_Plugin' ) ) {
					santos_single_sharing_buttons();
				}
			}
			?>

			<div class="clearfix"></div>

			<?php endwhile; endif; ?>


			<div class="clearfix"></div>

			<?php comments_template(); ?>

		</div>


		<?php if ( $post_layout !='fullwidth' ) {  get_sidebar(); } ?>

		<div class="clearfix"></div>
	</div>
</div>
<!-- / blog section -->




<?php get_footer(); ?>