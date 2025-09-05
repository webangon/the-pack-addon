<?php

$slider_options = [
    'item' => esc_attr($settings['item']['size']),
    'item_tab' => esc_attr($settings['item_tab']['size']),
    'speed' => esc_attr($settings['speed']['size']),
    'space' => esc_attr($settings['space']['size']),
    'mouse' => ('yes' === $settings['mouse']),
    'auto' => ('yes' === $settings['auto']),
];

$pagi = $settings['dot'] ? '<div class="swiper-pagination"></div>' : '';

$previkn = $settings['picon']['value'] ? '<div class="khbprnx khbnxt"><i class="' . $settings['picon']['value'] . '"></i></div>' : '';
$nextikn = $settings['nicon']['value'] ? '<div class="khbprnx khbprev"><i class="' . $settings['nicon']['value'] . '"></i></div>' : '';

$icon = $settings['icon']['value'] ? '<i class="tbicon ' . $settings['icon']['value'] . '"></i>' : '';

$out1 = '';
foreach ($settings['items'] as $item) {
    switch ($settings['disp']) {
        case 'slider':
            $cls = 'swiper-slide';
            break;

        case 'grid':
            $cls = $settings['animation'];
            break;

        default:
    }

    $bg = $item['ftype'] == 'fimg' ? 'style="background-image:url(' . $item['fimgs']['url'] . ')"' : 'style="background:' . $item['fclrs'] . '"';
    $name = $item['name'] ? '<p class="name">' . $item['name'] . '</p>' : '';
    $pos = $item['pos'] ? '<p class="pos">' . $item['pos'] . '</p>' : '';
    $link = thepack_get_that_link($item['url']);

    $link = $item['url']['url'] ? '<a ' . $link . '"></a>' : '';

    $out1 .= '
            <div class="imgbx4 tbtr ' . $cls . '">
                <div class="team-container" ' . $bg . '>
                    ' . $link . '
                    <div class="team-content">
                        ' . $name . $pos . '
                        <div class="team-link">
                            ' . $icon . '
                        </div>

                    </div>
                </div>
            </div>
        ';
}

if ($settings['disp'] == 'slider') {
    echo '<div class="imgbx4carou swiper-container tpswiper" data-thop =\'' . wp_kses_post(wp_json_encode($slider_options)) . '\'>
                <div class="swiper-wrapper">';?>
                    <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    <?php echo thepack_build_html($out1);?>
                </div>
                <div class="swiper-pagination"></div>
                <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                <div class="tp-arrow"><?php echo thepack_build_html($previkn . $nextikn);?></div>
        ';
<?php } else {
    //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
    echo '<div class="imgbx4wrap tp-no-overflow">' . thepack_build_html($out1) . '</div>';
}
