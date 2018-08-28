<?php
//Questa parte mostra la liste delle categoria MACCHINE-VENDITA
?>
<?php query_posts('cat=115'); ?>
<div class="container macchine-vendita">
    <div class="row">
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

                <!-- Macchine vendita BLOCK END -->

                <!-- /.col-md-6 -->
            <?php endwhile; endif; ?>

        </div>
        <!-- /.col-md-10 col-md-offset-1 -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container macchine-vendita -->
<?php wp_reset_query(); ?>
