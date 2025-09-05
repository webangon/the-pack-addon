<?php
$out = '';
$anim = esc_attr($settings['anim']);
$btn = thepack_icon_svg($settings['btn'], 'plus-link');
foreach ($settings['items'] as $a) {
    $url = thepack_get_that_link($a['link']);
    $link = $a['link']['url'] ? '<div class="btn-wrap"><a class="more-btn" ' . $url . '>' . $btn . '</a></div>' : '';
    $title = thepack_build_html($a['title'], 'h3', 'title');
    $out .= '
		<div class="items style-1 ' . $anim . '">
			<div class="inner">
				' . thepack_build_html($this->icon_image($a) . $title . $link) . '
			</div>
		</div>
	';
}

?>
<div class="minibox-1 tp-no-overflow">
	<?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo thepack_build_html($out); ?>
</div>
