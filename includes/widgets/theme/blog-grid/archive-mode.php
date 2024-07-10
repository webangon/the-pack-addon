<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
        <div class="grid-item has-zoom-slide">
			<?php include THE_PACK_PLUGIN_DIR . 'includes/loop/post-loop-' . $loop_style . '.php'; ?>
        </div>
 
	<?php endwhile; ?>

	<?php wp_reset_postdata(); ?>

<?php endif;?>
