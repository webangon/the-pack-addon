<?php
global $product;
if ( empty( $product ) ) {
	return;
}

do_action( 'woocommerce_product_meta_start' );
echo '<ul class="raw-style product-single-meta">';
foreach ($settings['items'] as $tab) {
	if (ctype_alnum($tab['metas']) ){
		include plugin_dir_path(__FILE__) . esc_attr($tab['metas']) . '.php';
	}
}
echo '</ul>';
do_action( 'woocommerce_product_meta_end' );
?>