<?php
$img = thepack_ft_images($settings['img']['id'], $settings['main_size']);
$main = $settings['img'] ? '<div class="main-img">' . $img . '</div>' : '';
?>

<div class="tp-layerimage">
	<?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo $main . $this->content($settings['image_layers']); ?>
</div>