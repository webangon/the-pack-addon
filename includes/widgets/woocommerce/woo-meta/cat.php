<?php
global $product;
if ( empty( $product ) ) {
	return;
}
$icon = the_pack_render_icon( $tab['icn'] );
?>
<?php echo '<li><span class="label">'.$icon.$tab['lbl'].'</span><span class="label-right">'.wc_get_product_category_list( $product->get_id()).'</span></li>';//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped  ?>