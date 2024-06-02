<?php
global $post;
if ( empty( $post ) ) {
	return;
}
if ( $settings['source'] == 'content' ){
	$the_content = apply_filters( 'the_content', get_the_content( '', '', $post->ID ) );
	if ( ! empty( $the_content ) ) {
		//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '<div class="woocommerce-product-details__short-description">' .$the_content .'</div>';
	}
} else {
    woocommerce_template_single_excerpt();
}
?>
