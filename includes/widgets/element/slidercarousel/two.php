<?php

foreach ($settings['lists'] as $a) {
    $img = $a['bg'] ? '<figure>' . wp_get_attachment_image($a['bg']['id'], $settings['img_size']) . '</figure>' : '';
    $url = (empty($a['url']['url'])) ? ' ' : esc_url($a['url']['url']);
    $target = $a['url']['is_external'] ? 'target="_blank"' : '';

    $title = $a['title'] ? '<h2 class="title">' . $a['title'] . '</h2>' : '';
    $cat = $a['cat'] ? '<span class="cat">' . $a['cat'] . '</span>' : '';

    $out = '<div class="slide-inner">' . $img . '<div class="inner-wrap">' . $cat . $title . '</div></div>';
    $out1 .= $a['url']['url'] ? '<div class="swiper-slide"><a href="' . esc_url($a['url']['url']) . '">' . $out . '</a></div>' : '<div class="swiper-slide">' . $out . '</div>';
}
