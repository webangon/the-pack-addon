<?php
global $product;
if ( empty( $product ) ) {
	return;
}
$text = $product->is_in_stock() ? 'in stock' : 'out of stock';
$icon = the_pack_render_icon( $tab['icn'] );

//$product = wc_get_product( $p_id );
$manage = $product->get_manage_stock();
$stock_status = $product->get_stock_status();
$stock_quantity = $product->get_stock_quantity(); 
echo '<li><span class="label">'.thepack_build_html($icon.$tab['lbl']).'</span><span class="label-right">'.thepack_build_html($stock_quantity.$text).'</span></li>';//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
?>
