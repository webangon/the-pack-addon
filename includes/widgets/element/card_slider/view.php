<?php
$slider_options = [
    'speed' => ($settings['auto'] ? $settings['speed']['size'] : ''),
    'auto' => ('yes' === $settings['auto']),
];
$dots = $settings['dot'] ? '<div class="blog-slider__pagination"></div>' : '';
?>

<div class="blog-slider">
	<?php echo '<div class="blog-slider__wrp swiper-wrapper" data-xld =\'' . wp_json_encode($slider_options) . '\'>'; ?>
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo $this->content($settings['items'], $settings['img_size']); ?>
</div>
<?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
<?php echo thepack_build_html($dots); ?>
</div>


