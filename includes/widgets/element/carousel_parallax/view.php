<?php

$slider_options = [
    'item' => $settings['item']['size'],
    'item_tab' => $settings['itemtab']['size'],
    'speed' => $settings['speed']['size'],
    'space' => $settings['space']['size'],
    'auto' => ('yes' === $settings['auto']),
    'center' => ('yes' === $settings['center']),
    'mouse' => ('yes' === $settings['mouse']),
];
$out = '';

foreach ($settings['items'] as $item) {
    $bg = thepack_bg_images($item['img']['id'], 'full');
    $out .= '
        <div class="swiper-slide">
            <div class="slide-image" style="background-image: url(' . $item['img']['url'] . ')">
            </div>
        </div>
      ';
}
?>

<?php echo '<div class="swiper-container parallax-carousel" data-xld =\'' . wp_json_encode($slider_options) . '\'>'; ?>
<div class="swiper-wrapper">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo thepack_build_html($out); ?>
</div>
</div>