<?php
$new_array = array_chunk($settings['tabs'], 2);
$btnicon = $settings['btnikn']['value'] ? '<i class="' . $settings['btnikn']['value'] . '"></i>' : '';

echo '<div class="tp-special-iconbox ' . esc_attr($settings['tmpl']) . '">';
$first = 0;
foreach ($new_array as $group_of_four) {
    $first++;
    if ($first == 1) {
        $cls = '';
    } else {
        $cls = 'tp-alt';
    }
    echo '<div class="items ' . esc_attr($cls) . '">';
    foreach ($group_of_four as $one) {
        $title = thepack_build_html($one['title'], 'h3', 'title');
        $desc = thepack_build_html($one['desc'], 'p', 'desc');
        $iconimg = $this->icon_image($one);
        $link = thepack_get_that_link($one['url']);
        $btn = $one['btn'] ? '<a ' . $link . ' class="theme-btn">' . $one['btn'] . $btnicon . '</a>' : '';
        //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
        echo '<div class="item ' . esc_attr($settings['anim']) . '">' . $iconimg . $title . $desc . $btn . '</div>';
    }

    echo '</div>';
}
echo '</div>';
