<?php get_header(); ?>
<!-- titlebar -->
<?php santos_titlebar(); ?>

<!--single Page-->
<?php
$santos_options = get_option('santos_options');

$page_layout = 'fullwidth';
$page_container = "no-container";
if (isset($santos_options['page_layout'])) {
	$page_layout = $santos_options['page_layout'];
}

if (isset($santos_options['page_container'])) {
	$page_container = $santos_options['page_container'];
}

$page_container = rwmb_meta( 'santos_page_container' ) ? rwmb_meta( 'santos_page_container' ) : $page_container;

if ( class_exists( 'WooCommerce' ) ) {
	if(is_account_page() || is_woocommerce() || is_cart() || is_checkout() ){$page_container = "container";}
}

$page_layout = rwmb_meta( 'santos_page_layout' ) ? rwmb_meta( 'santos_page_layout' ) : $page_layout;
$page_padding = $disable_page_padding = '';
$disable_page_padding = rwmb_meta( 'santos_disable_page_padding' );
$page_padding = ($disable_page_padding == 'true') ? 'no-padding-wrap' : 'padding-wrap';
$titlebar_style = isset($santos_options['default_titlebar_style']) ? $santos_options['default_titlebar_style'] : 'minimal';
$titlebar_style = rwmb_meta( 'santos_titlebar_style') ? rwmb_meta( 'santos_titlebar_style') : $titlebar_style ;

$enable_onepage_navigator = rwmb_meta( 'santos_enable_onepage_navigator' );

?>

<!-- Page section -->
<div class="page-wrapper <?php echo esc_attr($page_padding); ?>">
	<div class="<?php echo esc_attr($page_container); ?> layout-<?php echo esc_attr($page_layout); ?>">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="post-content <?php if ( $page_layout !='fullwidth' ) { ?> col-md-8  <?php }else{?> col-md-12 <?php } ?>">
			<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

				<?php
				$disable_feature = rwmb_meta( 'santos_post_disable_feature')? rwmb_meta( 'santos_post_disable_feature' ) : 'false';
				if($disable_feature == 'false'){
					if($titlebar_style == 'minimal' &&  has_post_thumbnail()  )
					{

						the_post_thumbnail('post-thumbnail', array('class' => 'img-responsive img-rounded', 'title' => 'Feature image'));
						echo '<div class="h-50"></div>';
					}
				}
				?>

				<?php
				if($enable_onepage_navigator == 'true'){echo '<div class="onepage_navigator"></div><div id="fullpage">'; }
				the_content();
				if($enable_onepage_navigator == 'true'){echo '</div>'; }
				?>

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



			<?php the_tags( '<div class="tags"><p><strong>' . esc_html__( 'Post Tags', 'santos' ).' :</strong></p> <ul class="post-tags clearlist rightList space20" ><li>', '</li><li>', '</li></ul></div>' ); ?>


			<?php


			if (isset($santos_options[ 'enable_page_share']) && $santos_options[ 'enable_page_share']=="1" ) {
				if( class_exists( 'Santos_Core_Plugin' ) ) {
					santos_single_sharing_buttons();
				}
			}
			?>


			<div class="clearfix"></div>

			<?php endwhile; endif; ?>


			<!-- Macchine vendita loop category START -->

			<?php get_template_part('partials/macchine', 'vendita') ?>

			<!-- Macchine vendita loop category END -->


			<div class="clearfix"></div>

			<?php comments_template(); ?>

		</div>


		<?php if ( $page_layout !='fullwidth' ) {  get_sidebar(); } ?>

		<div class="clearfix"></div>

	</div>
</div><!-- / Page section -->


<!-- related section -->
<?php
if (isset($santos_options[ 'enable_post_related']) && $santos_options[ 'enable_post_related']=="1" ) {
	santos_blog_related_posts($post->ID) ;
}
?>

<!-- / related section -->

<?php get_footer(); ?>