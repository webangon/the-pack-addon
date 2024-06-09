<?php
global $product;
if ( empty( $product ) ) {
	return;
}
$icon = the_pack_render_icon( $tab['icn'] );
?>
<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

<li><span class="label"><?php echo thepack_build_html($icon.$tab['lbl']);//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?> </span><span class="label-right"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></li>

<?php endif; ?> 