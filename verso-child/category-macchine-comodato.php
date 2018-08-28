<?php get_header(); ?>

<?php


if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }


?>

<!-- Page section -->
<div class="page-wrapper row">
	<div class="container archivio-macchine macchine-vendita">
		<?php
		$current_category = get_the_archive_title();
		?>
		<h1 class="text-center page-title"><?php echo $current_category; ?></h1>
		<div class="col-md-10 col-md-offset-1 main-archive-wrapper">
			<?php if(have_posts()) { while( have_posts()) : the_post(); ?>
				<!-- Macchine vendita BLOCK START -->

				<div class="col-sm-6 col-md-6 item-fadeIn">
					<div class="archive-wrapper">
						<?php  $id = get_the_ID(); ?>
						<div class="col-xs-6 first-half text-center post_<?php echo $id ?>">
							<h2 class=""><?php the_title() ?></h2>
							<a  href="<?php the_permalink(); ?>" class="btn-more">Scopri di più</a>
						</div>

						<div class="col-xs-6 second-half">
							<?php

							if ( has_post_thumbnail() ) {
								$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "full" );

								echo '<a href="'. get_the_permalink().'">
                                <img src="'. $imgsrc[0].' " alt="'. get_the_title()  .'" class="img-responsive" />
                                </a>';
							}
							?>
						</div>
					</div>
				</div>
			<?php endwhile; ?>

				<?php
			}else{ ?>

				<h2><?php esc_html_e('No Posts Found', 'santos') ?></h2>
			<?php } ?>
			<!-- /.col-md-6 -->

			<?php

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
	</div>
	<!-- /.container macchine-vendita -->
</div>
<!-- /.container -->




<?php get_footer(); ?>
