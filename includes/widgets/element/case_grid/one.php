<?php
$out1 = '';
$i = 0;
$big = ['1', '5', '9'];
$mid = ['2', '6', '10'];
foreach ($settings['items'] as $item) {
    $i++;
    $bg = $item['fimgs']['id'] ? thepack_bg_images($item['fimgs']['id'], $item['img_size']) : '';
    $name = $item['name'] ? '<h2 class="name">' . $item['name'] . '</h2>' : '';
    $pos = $item['pos'] ? '<p class="pos">' . $item['pos'] . '</p>' : '';
    $link = thepack_get_that_link($item['url']);
    $link = $item['url']['url'] ? '<a ' . $link . '"></a>' : '';

    if (in_array($i, $big)) {
        $cls = 'case-big ' . $settings['animation'];
    } elseif (in_array($i, $mid)) {
        $cls = 'case-mid ' . $settings['animation'];
    } else {
        $cls = 'case-small ' . $settings['animation'];
    }

    $out1 .= '
        <div class="case-wrap tbtr ' . $cls . ' elementor-repeater-item-' . $item['_id'] . '">
            <div ' . $bg . ' class="inner lazyload">
                ' . $link . '
                <div class="case-content">
                    ' . $name . $pos . '
                </div>
            </div>
        </div>
    ';
}
//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
echo '<div class="tp-case-grid style-one tpoverflow">' . $out1 . '</div>';
