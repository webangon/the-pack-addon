<?php

$speed = $settings['speed']['size'];
$space = $settings['space']['size'];
$item = $settings['item']['size'];
$item_tab = $settings['item_tab']['size'];

$slider_options = [
    'item' => $item,
    'item_tab' => $item_tab,
    'speed' => $speed,
    'space' => $space,
    'mouse' => ('yes' === $settings['mouse']),
];

$previkn = $settings['picon']['value'] ? '<div class="khbprnx khbnxt"><i class="' . $settings['picon']['value'] . '"></i></div>' : '';
$nextikn = $settings['nicon']['value'] ? '<div class="khbprnx khbprev"><i class="' . $settings['nicon']['value'] . '"></i></div>' : '';

if ($settings['disp'] == 'slider') {
    echo '<div class="swiper-container tpswiper team1carou" data-xld =\'' . wp_json_encode($slider_options) . '\'>
                <div class="swiper-wrapper">';?>
                    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    <?php echo $this->content($settings['items'], $settings['anim'], $settings['disp']);?>
                </div><div class="swiper-pagination"></div>
                <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                <div class="tp-arrow"><?php echo thepack_build_html($previkn . $nextikn);?></div>
        ';
<?php } else {
    //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
    echo '<div class="tbteam1 tpoverflow">' . $this->content($settings['items'], $settings['anim'], $settings['disp']) . '</div>';
}
