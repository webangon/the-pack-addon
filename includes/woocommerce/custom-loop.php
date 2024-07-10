<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0  swiper-slide
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$id = $product->get_id();	
$option = [
	'type'=> 'percen',
	'label'=> 'sale',
]; 

?>
<div <?php wc_product_class($inclass, $product ); ?>>
	<?php
	echo '<div class="inner">';
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */ 
	echo '<div class="tp-product-thumbnail">';
		do_action( 'woocommerce_before_shop_loop_item_title' );
		call_user_func('The_Pack_Woo_Helper::product_thumbnail', $settings['img_size']);
		call_user_func('The_Pack_Woo_Helper::on_sale', $product,$option);
		echo '<a data-id="'.$id.'" class="tp-quick-view" href="#"><i class="tivo ti-search" aria-hidden="true"></i></a>';//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped 
	echo '</div>';
	/**
	 * Hook: woocommerce_shop_loop_item_title.    
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	do_action( 'woocommerce_shop_loop_item_title' );
	call_user_func('The_Pack_Woo_Helper::product_title');
	call_user_func('The_Pack_Woo_Helper::product_rating',$product,$settings['hide']);
	/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	echo '</div>';
	?>
</div>
