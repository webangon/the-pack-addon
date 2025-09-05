<?php

$anim = $settings['animation'];
switch ($settings['display']) {
    case 'grid':
        $cls = 'items' . ' ' . $anim;
        break; 

    case 'carousel':
        $cls = 'swiper-slide';
        break; 

    default:
}

if ($settings['display'] == 'carousel') {
    $slider_options = [
        'item' => esc_attr($settings['item']['size']),
        'item_tab' => esc_attr($settings['item_tab']['size']),
        'speed' => esc_attr($settings['speed']['size']),
        'space' => esc_attr($settings['space']['size']),
        'mouse' => ('yes' === $settings['mouse']),
        'auto' => ('yes' === $settings['auto']),
        'center' => ('yes' === $settings['center']),
    ];

    $previkn = $settings['picon']['value'] ? '<div class="khbprnx khbnxt"><i class="' . $settings['picon']['value'] . '"></i></div>' : '';
    $nextikn = $settings['nicon']['value'] ? '<div class="khbprnx khbprev"><i class="' . $settings['nicon']['value'] . '"></i></div>' : '';
    $nav = $settings['nav'] ? '<div class="tp-arrow">' . $previkn . $nextikn . '</div>' : '';
    $dot = $settings['dot'] ? '<div class="swiper-pagination"></div>' : '';
    echo '<div class="swiper-container tpswiper tp-img-grid-slider" data-xld =\'' . wp_kses_post(wp_json_encode($slider_options)) . '\'>
            <div class="swiper-wrapper">';?>
            <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            <?php $this->content($settings['items'], $cls, $settings['bticon'], $settings['img_size']);?>
            </div>
            <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            <?php echo $dot . $nav;?>     

    </div>;
<?php } else {
    //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
    echo '<div class="tp-img-grid-slider tp-no-overflow">' .$this->content($settings['items'], $cls, $settings['bticon'], $settings['img_size']) . '</div>';
}

?>

