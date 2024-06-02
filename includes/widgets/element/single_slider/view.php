<?php

$slider_options = [
    'speed' => $settings['speed']['size'],
    'auto' => ('yes' === $settings['auto']),
    'vertical' => ('yes' === $settings['vert']),
    'fade' => $settings['fade'],
];

$previkn = $settings['picon']['value'] ? '<div class="prev-img"><i class="' . $settings['picon']['value'] . '"></i></div>' : '';
$nextikn = $settings['nicon']['value'] ? '<div class="next-img"><i class="' . $settings['nicon']['value'] . '"></i></div>' : '';
$arrow = $settings['arrow'] ? '<div class="tp-slider-single-nav">' . $previkn . $nextikn . '</div>' : '';
$dot = $settings['dot'] ? '<div class="tp-pagination"></div>' : '';
$main = '';
foreach ($settings['galleries'] as $item) {
    $avatar = thepack_ft_images($item['id'], $settings['img_size']);
    $thmbn = thepack_ft_images($item['id'], 'thumbnail');
    $main .= '
            <div class="swiper-slide"><div class="swiper-slide-container">
                ' . $avatar . '
            </div></div>
        ';
}

echo '<div data-xld =\'' . wp_json_encode($slider_options) . '\' class="tpsingle-slide ' . esc_attr($settings['pagityp']) . ' ' . esc_attr($settings['arrowtyp']) . '">';
?>
<div class="swiper-container gallery-top">
    <div class="swiper-wrapper">
        <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php echo thepack_build_html($main); ?>
    </div>
</div>
<?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
<?php echo thepack_build_html($arrow . $dot); ?>
</div>
