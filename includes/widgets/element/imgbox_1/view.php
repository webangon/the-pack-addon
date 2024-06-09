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
        'item' => $settings['item']['size'],
        'item_tab' => $settings['item_tab']['size'],
        'speed' => $settings['speed']['size'],
        'space' => $settings['space']['size'],
        'mouse' => ('yes' === $settings['mouse']),
        'auto' => ('yes' === $settings['auto']),
        'center' => ('yes' === $settings['center']),
    ];

    $previkn = $settings['picon']['value'] ? '<div class="khbprnx khbnxt"><i class="' . $settings['picon']['value'] . '"></i></div>' : '';
    $nextikn = $settings['nicon']['value'] ? '<div class="khbprnx khbprev"><i class="' . $settings['nicon']['value'] . '"></i></div>' : '';
    $nav = $settings['nav'] ? '<div class="tp-arrow">' . $previkn . $nextikn . '</div>' : '';
    $dot = $settings['dot'] ? '<div class="swiper-pagination"></div>' : '';
    echo '<div class="swiper-container tpswiper tb-imgbox1" data-thop =\'' . wp_json_encode($slider_options) . '\'>
            <div class="swiper-wrapper">';?>
                <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                <?php echo $this->content($settings['items'], $cls, $settings['bticon'], $settings['img_size']);?>
            </div>
            <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            <?php echo thepack_build_html($dot. $nav) ;?>     
    ';
    </div>
<?php } else {
    //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
    echo '<div class="tb-imgbox1 tpoverflow">' .$this->content($settings['items'], $cls, $settings['bticon'], $settings['img_size']) . '</div>';
}

?>

