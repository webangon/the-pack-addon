<?php
global $product;
if ( empty( $product ) ) {
	return;
}
$icon = the_pack_render_icon( $tab['icn'] );
$has_tag = wp_get_post_terms($product->get_id(), 'product_tag');
if (!$has_tag) {
	return;
}
?>

<?php echo '<li><span class="label">'.$icon.$tab['lbl'].'</span><span class="label-right">'.wc_get_product_tag_list( $product->get_id()).'</span></li>';//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
 