<?php

$animation = $settings['animation'];

?>

<div class="tb-process-1 tp-no-overflow <?php echo esc_attr($settings['tmpl']); ?>">
	<?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo $this->content($settings['items'], $settings['tmpl'], $animation); ?>
</div>

