<?php
foreach ($settings['lists'] as $a) {
    $desc = thepack_build_html($a['desc'], 'p', 'desc');
    $title = thepack_build_html($a['title'], 'h2', 'title');
    $pre = thepack_build_html($a['pre'], 'span', 'pre');

    $link = thepack_get_that_link($a['url']);
    $btn = $a['btn'] ? '<a ' . $link . ' class="tour-btn">' . $a['btn'] . '</a>' : '';

    $out .= '<div class="swiper-slide">
				<div class="tbcontent">
					<div class="img-inner">
						' . wp_get_attachment_image($a['bg']['id'], 'full', '', ['class' => 'tp-thumb tbtr']) . '
					</div>
					<div class="inner">' . $pre . $title . $desc . $btn . '</div>
				</div>
			</div>';

    $pagination = $settings['dot'] ? '<div class="swiper-pagination"></div>' : '';
    $arraow = $a['btn'] ? '<div class="tp-arrow">' . $previkn . $nextikn . '</div>' : '';
}
