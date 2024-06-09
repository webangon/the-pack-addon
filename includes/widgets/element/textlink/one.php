<?php

$url = thepack_get_that_link($settings['url']);
$icon = $settings['icon']['value'] ? '<i class="tbicon ' . $settings['icon']['value'] . '"></i>' : '';
$slink = $settings['url']['url'] ? '<a class="link" ' . $url . '>' . $settings['link'] . $icon . '</a>' : '';
$out = $settings['text'] . $slink;

?>

<div class="jl-textlink <?php echo esc_attr($settings['tmpl']); ?>">
	<?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo thepack_build_html($out); ?>
</div>