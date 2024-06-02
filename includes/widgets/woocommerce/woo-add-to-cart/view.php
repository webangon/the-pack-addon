<?php
global $product;
if ( empty( $product ) ) {
	return;
}
  

add_filter( 'woocommerce_get_stock_html', function ( $html, $product ) {
    return '';
  }, 10, 2);

$options = [
  'cart' => the_pack_render_icon($settings['cicon'])
];  

echo '<div class="tpsinglecart" data-xld =\'' . wp_json_encode($options) . '\'>';
woocommerce_template_single_add_to_cart();
echo '</div>';
?>