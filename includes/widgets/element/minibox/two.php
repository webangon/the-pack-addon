<?php

$out = '';
$anim = esc_attr($settings['anim']);
$btn = thepack_icon_svg($settings['btn'], 'plus-link');
foreach ($settings['items'] as $a) {
    $url = thepack_get_that_link($a['link']);
    $title = $a['link']['url'] ? '<h3 class="title"><a ' . $url . '>' . $a['title'] . '</a></h3>' : '<h3 class="title">' . $a['title'] . '</h3>';
    $out .= '
		<div class="items style-2 ' . $anim . '">
			<div class="inner">
				' . $this->icon_image($a) . $title . '
			</div>
		</div>
	';
}

?>
<div class="minibox-1 tp-no-overflow">
	<?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo thepack_build_html($out); ?>
</div>
