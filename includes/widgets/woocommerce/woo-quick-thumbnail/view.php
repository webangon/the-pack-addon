<?php
	$post_thumbnail_id = $product->get_image_id();
	if( ! $post_thumbnail_id ){
		$post_thumbnail_id = get_option( 'woocommerce_placeholder_image', 0 );
	}
	$attachment_ids = $product->get_gallery_image_ids();
	$out = '';

	if ( $attachment_ids ) {
		$arr = $attachment_ids;
		$arr = array_merge(array($post_thumbnail_id), $arr);
		$arr = array_filter(array_unique($arr));
		foreach ( $arr as $attachment_id ) {
			$html = wc_get_gallery_image_html( $attachment_id, true );
			$out.= '<div class="swiper-slide">'.apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id ).'</div>';
		}		
	} else {
		if ( $post_thumbnail_id ){
			$html = wc_get_gallery_image_html( $post_thumbnail_id, true );
			$out.= '<div class="swiper-slide">'.apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ).'</div>';		
		}
	}
?>
<div class="swiper-container tp-quick-thumb">
	<div class="swiper-wrapper">
		<?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?> 
		<?php echo thepack_build_html($out);?>
	</div>
	<a href="#" class="view-details-btn">
		View details	</a>
</div>		
