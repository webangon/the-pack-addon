<?php

$slider_options = [
    'speed' => esc_attr($settings['speed']['size']),
    'auto' => ('yes' === $settings['auto']),
];

$out = '';

$first = 0;
foreach ($settings['lists'] as $a) {
    $first++;
    if ($first == 1) {
        $fcls = 'active';
    } else {
        $fcls = '';
    }
    $img = $a['bg'] ? 'style="background-image:url(' . $a['bg']['url'] . ')"' : '';
    $title = $a['title'] ? '<h2 class="title">' . $a['title'] . '</h2>' : '';
    $cat = $a['cat'] ? '<span class="cat">' . $a['cat'] . '</span>' : '';
    $url = (empty($a['url']['url'])) ? ' ' : esc_url($a['url']['url']);
    $target = $a['url']['is_external'] ? 'target="_blank"' : '';

    $out .= '
	    <div class="post-item ' . $fcls . '">
	        <div class="slider-bg"><div class="inner"><div ' . $img . ' class="wrap"></div></div></div>
	        <a ' . $target . ' href="' . $url . '">
		        <div class="post-content">
		            <div class="slider-container">
		                <div class="content-entry">
		                    ' . $title . '
		                    ' . $cat . '
		                </div>
		            </div>
		        </div>
	        </a>
	    </div>
	';
}
echo '<div class="bari_assex_slider" data-xld =\'' . wp_kses_post(wp_json_encode($slider_options)) . '\'><div class="flex-equal assex-wrap">';
//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
echo thepack_build_html($out);
echo '</div></div>';
?>

