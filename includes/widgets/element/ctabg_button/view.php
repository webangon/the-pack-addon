<?php
$cls = $settings['opaq'];
?>
<div class="tb-imgrid tp-no-overflow">
	<?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo $this->content($settings['items'], $settings['anim'], $settings['btni']); ?>
</div>
