<?php
global $product;
if ( empty( $product ) ) {
	return;
}
$average = $product->get_average_rating();
$rating_count = $product->get_rating_count();
$width = $average*20 .'%';

$icon = the_pack_render_icon( $tab['icn'] );
$label = $icon || $tab['lbl']  ? '<span class="label">'.$icon.$tab['lbl'].'</span>' : '';
?>
<?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
<li><?php echo thepack_build_html($label);?><span class="label-right"><span class="tp-avarage-rating tp-dinflex"><span class="tscore"><span style="width: <?php echo esc_attr($width);?>"></span></span><span class="count">(<?php echo esc_attr($rating_count);?>)</span></span></span></li>