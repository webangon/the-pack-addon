<?php
$cross_sells = array_filter( array_map( 'wc_get_product', WC()->cart->get_cross_sells() ), 'wc_products_array_filter_visible' );
//var_dump( WC()->cart->get_cross_sells() );
?>
