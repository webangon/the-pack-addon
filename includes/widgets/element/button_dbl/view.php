<?php

$ficon = $settings['ficon'] ? '<i class="' . $settings['ficon']['value'] . '"></i>' : '';
$sicon = $settings['sicon'] ? '<i class="' . $settings['sicon']['value'] . '"></i>' : '';

$link1 = thepack_get_that_link($settings['url1']);
$btn1 = $settings['btn1'] ? '<div class="dual2wrp"><a ' . $link1 . ' class="dual1">' . $ficon . $settings['btn1'] . '</a></div>' : '';

if ($settings['tmpl'] == 'one') {
    $link2 = thepack_get_that_link($settings['url2']);
    $btn2 = $settings['btn2'] ? '<div class="dual1wrp"><a ' . $link2 . ' class="dual2">' . $sicon . $settings['btn2'] . '</a></div>' : '';
} elseif ($settings['tmpl'] == 'two') {
    $icon = $settings['icon']['value'] ? '<i class="' . $settings['icon']['value'] . '" aria-hidden="true"></i>' : '<i class="fa fa-play"></i>';
    $vidattr = $settings['vidurl'] ? 'data-vidlink="' . $settings['vidurl'] . '"' : '';
    $btn2 = $settings['icon']['value'] ? '<div class="dual1wrp"><div ' . $vidattr . ' class="inrwrp vidbtn">' . $icon . '</div></div>' : '';
} else {
    $sep = $settings['septxt'] ? '<div class="dualsep">' . $settings['septxt'] . '</div>' : '';
    $btn2 = $settings['txt'] ? '' . $sep . '<div class="dual1wrp"><span class="dual2">' . $settings['txt'] . '</span></div>' : '';
}
//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
echo '<div class="dualbtninr ' . esc_attr($settings['tmpl']) . '"><div class="dualbtnwrp">' . the_pack_html_escaped($btn1 . $btn2) . '</div></div>';

?>