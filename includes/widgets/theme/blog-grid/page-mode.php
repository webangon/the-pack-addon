<?php if ($loop->have_posts()) : ?>
	<?php while ($loop->have_posts()) : $loop->the_post(); ?>

        <div class="grid-item has-zoom-slide">
			<?php include THE_PACK_PLUGIN_DIR . 'includes/loop/post-loop-' . $loop_style . '.php'; ?>
        </div>
 
	<?php endwhile; ?>

	<?php wp_reset_postdata(); ?>

<?php endif; ?>