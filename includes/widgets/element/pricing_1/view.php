<?php
$cls = $settings['hraised'] . ' ' . $settings['shadow'];
?>

<div class="tb-pricing1 tpoverflow <?php echo esc_attr($cls); ?>">
	<?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo the_pack_html_escaped($this->content($settings['items'], $settings['animation'])); ?>
</div>


