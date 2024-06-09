<?php

$animation = $settings['animation'];

?>

<div class="tb-process-1 tpoverflow <?php echo esc_attr($settings['tmpl']); ?>">
	<?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo $this->content($settings['items'], $settings['tmpl'], $animation); ?>
</div>

