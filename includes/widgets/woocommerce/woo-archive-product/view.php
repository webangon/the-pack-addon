
<?php
do_action( 'woocommerce_before_main_content' );
// column_per_row. 
if ( woocommerce_product_loop() ) {
	do_action( 'woocommerce_before_shop_loop' );
	woocommerce_product_loop_start();
	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();
			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );
			wc_get_template_part( 'content', 'product' );
		}
	}  
	woocommerce_product_loop_end();
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}
do_action( 'woocommerce_after_main_content' );
?>

<style>
.tp-before-shop {
    display: flex;
    justify-content: space-between;  
}
.tp-before-shop .woocommerce-result-count,.tp-before-shop .per-page-products{
    display: flex;
    align-content: center;
    flex-wrap: wrap;	
}
.woocommerce .tp-before-shop .woocommerce-result-count,.woocommerce .tp-before-shop .woocommerce-ordering{
    margin-bottom: 0;
}
.remove-filter li{
  display:inline;
}

</style>
