<?php

$slider_options = [
    'speed' => $settings['speed']['size'],
    'arrow' => ('yes' === $settings['arrow']),
    'auto' => ('yes' === $settings['auto']),
    'parallax' => $settings['prlx'],
    'bgpos' => $settings['bgpos']['size'],
];

$previkn = $settings['picon']['value'] && $settings['arrow'] ? '<div class="swiper-button-prev prnx"><i class="' . $settings['picon']['value'] . '"></i></div>' : '';
$nextikn = $settings['nicon']['value'] && $settings['arrow'] ? '<div class="swiper-button-next prnx"><i class="' . $settings['nicon']['value'] . '"></i></div>' : '';
$dot = $settings['dot'] ? '<div class="swiper-pagination"></div>' : '';
$main = '';
foreach ($settings['lists'] as $item) {
    $img = 'style="background-image: url(' . $item['bg']['url'] . ')"';
    $btn1 = $item['btn1'] ? '<a ' . thepack_get_that_link($item['url1']) . '>' . $item['btn1'] . '</a>' : '';
    $btn2 = $item['btn2'] ? '<a ' . thepack_get_that_link($item['url2']) . '>' . $item['btn2'] . '</a>' : '';
    $main .= '
              <div class="swiper-slide  elementor-repeater-item-' . $item['_id'] . '">
                <div class="slide-inner">
                  <div ' . $img . ' class="slide-bg-image"></div>
                  <div class="content-wrap"><div class="content-inner">
                      ' . thepack_build_html($item['pre'], 'span', 'pre') . '
                      ' . thepack_build_html($item['title'], 'h2', 'title') . '
                      ' . thepack_build_html($item['desc'], 'p', 'desc') . '
                    <div class="slide-btns">
                      ' . $btn1 . '
                      ' . $btn2 . '
                    </div>
                  </div></div>
                </div>
              </div>
        ';
}

echo '<div class="tp-main-slider ' . esc_attr($settings['trnsl']) . '" data-xld =\'' . wp_json_encode($slider_options) . '\'>';
?>
<div class="swiper-container">
    <div class="swiper-wrapper">
    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php echo thepack_build_html($main); ?>
    </div>
  <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>  
	<?php echo thepack_build_html($dot . $previkn . $nextikn); ?>

</div>
</div>
