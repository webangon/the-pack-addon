<?php
global $product;
if ( empty( $product ) ) {
	return;
}
if( $product->is_on_sale()){
	$settings['price_cls'] = 'sale-price';
} else {
	$settings['price_cls'] = 'regular-price';
}

woocommerce_template_single_price();

?>

<style>
	.woocommerce div.product p.price ins{
		text-decoration: none;
	}
	.woocommerce div.product p.price del{
		opacity:1;
	}
</style>