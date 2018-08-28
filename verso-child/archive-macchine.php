<?php get_header(); ?>
<!-- Page section -->
<div class="page-wrapper row">
	<div class="container archivio-macchine macchine-vendita">
        <h1 class="text-center page-title">Le macchine</h1>
                <div class="col-md-10 col-md-offset-1 main-archive-wrapper">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
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
                        <!-- /.col-md-6 -->
					<?php endwhile; endif; ?>
                </div>

        </div>
        <!-- /.container macchine-vendita -->
    </div>
	<!-- /.container -->

<?php get_footer(); ?>
