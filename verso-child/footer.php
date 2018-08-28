<?php
/**
 * SANTOS Footer
 * Displays all of the <footer> section and everything up till the end of body>
 */
?>


	<?php santos_footer_layout(); ?>


	<?php if (function_exists('santos_append_global_dynamic_styles')) {  santos_append_global_dynamic_styles(); } ?>	




    <!-- /#fullWidth-image -->
    <?php if(in_category('macchine-comodato' || 'macchine-vendita')){ ?>

        <?php get_template_part('partials/modal', 'related-products') ?>

    <?php } ?>
<?php wp_footer(); ?>

</body>
</html>