<?php
$cls = $settings['hrotate'];
?>
<div class="tb-timeline-1 <?php echo esc_attr($cls); ?>">
	<?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo $this->content($settings['items'], $settings['animation']); ?>
</div>

