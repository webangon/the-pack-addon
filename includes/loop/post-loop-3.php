<?php
  $bg = get_the_post_thumbnail_url(get_the_ID(), esc_attr($settings['img_size']));
  $bg_style = $bg ? 'style="background-image:url(' . $bg . ');" ' : '';
?>
<article class="tp-post-3">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
    <div <?php echo $bg_style; ?> class="thumb-box"></div>
    <div class="grid-content">
		  <?php thepack_build_postmeta($meta, $excerpt); ?>
    </div>
</article> 