<?php
global $product;

if ( empty( $product ) ) {
	return;
}
//TODO: if gloabl product$product = wc_get_product(2074);

add_filter( 'woocommerce_gallery_image_size',function( $array ) use ( $settings ) {
    
	if ( ! $settings ) {
		return;
	}            
	return $settings['img_size'];
} 
);

$options = [
    'zoom' => the_pack_render_icon($settings['zoomicn']),
    'prev' => the_pack_render_icon($settings['picon']),
    'next' => the_pack_render_icon($settings['nicon'])
];

echo '<div class="thepack-product-images tpoverflow has-zoom" data-xld =\'' . wp_json_encode($options) . '\'>';
?>
	<?php woocommerce_show_product_sale_flash(); ?>
	<?php woocommerce_show_product_images(); ?>
</div>
