<?php
global $woocommerce,$product;
if ( empty( $product ) || ! wc_review_ratings_enabled() ) {
	return;
}
call_user_func('The_Pack_Woo_Helper::product_rating',$product,$settings);
?>