<?php
$cls = $settings['opaq'];
?>
<div class="tb-imgrid tpoverflow">
	<?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo the_pack_html_escaped($this->content($settings['items'], $settings['anim'], $settings['btni'])); ?>
</div>
