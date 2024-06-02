<?php
$emphasis = $settings['emphasis'] ? 'data-firstletter="' . $settings['emphasis'] . '"' : '';
$out = '<h2 class="heading" ' . $emphasis . '>' . $settings['heading'] . '</h2>';
?>
<div class="tbheader1">
	<?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo thepack_build_html($out); ?>
</div>