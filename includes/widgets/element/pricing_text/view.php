<?php

$decimal = $settings['decimal'] ? '<span class="tp-decimal">' . $settings['decimal'] . '</span>' : '';
$price = $settings['price'] ? '<span class="tp-price">' . $settings['price'] . $decimal . '</span>' : '';
$currency = $settings['currency'] ? '<span class="tp-currency">' . $settings['currency'] . '</span>' : '';
$duration = $settings['duration'] ? '<span class="tp-duration">' . $settings['duration'] . '</span>' : '';

?>

<div class="tp-pricing-text">
	<?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo thepack_build_html($currency . $price . $duration); ?>
</div>