<article class="tp-post-2">
	<?php if (has_post_thumbnail()) { ?>
        <div class="thumb-box">
            <a class="tp-thumblink" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
        <?php if (!$hide_thumb){
          the_post_thumbnail($settings['img_size']);
        } ?>   
        </div>
	<?php } ?>
    <div class="grid-content">
		<?php thepack_build_postmeta($meta, $excerpt); ?>
    </div>
</article>