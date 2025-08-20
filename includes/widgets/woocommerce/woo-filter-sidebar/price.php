<?php

global $product;
if ( empty( $product ) ) {
	return;
}
    global $wp;
    if ( version_compare( get_option( 'woocommerce_db_version', null ), '3.6', '<' ) ) {
        return;
    }

    if ( ! is_shop() && ! is_product_taxonomy() ) {
        return;
    }

    // If there are not posts and we're not filtering, hide the widget.
    if ( ! WC()->query->get_main_query()->post_count && ! isset( $_GET['min_price'] ) && ! isset( $_GET['max_price'] ) ) {//phpcs:disable WordPress.Security.NonceVerification.Recommended
        return;
    }

	$title = $value['lbl'] ? '<h3>'.$value['lbl'].'</h3>' : '';

    wp_enqueue_script( 'wc-price-slider' );

    // Round values to nearest 10 by default.
    $step = max( apply_filters( 'woocommerce_price_filter_widget_step', 10 ), 1 );

    // Find min and max price in current result set.
    $prices    = The_Pack_Woo_Helper::get_filtered_price();
    $min_price = $prices->min_price;
    $max_price = $prices->max_price;

    // Check to see if we should add taxes to the prices if store are excl tax but display incl.
    $tax_display_mode = get_option( 'woocommerce_tax_display_shop' );

    if ( wc_tax_enabled() && ! wc_prices_include_tax() && 'incl' === $tax_display_mode ) {
        $tax_class = apply_filters( 'woocommerce_price_filter_widget_tax_class', '' ); // Uses standard tax class.
        $tax_rates = WC_Tax::get_rates( $tax_class );

        if ( $tax_rates ) {
            $min_price += WC_Tax::get_tax_total( WC_Tax::calc_exclusive_tax( $min_price, $tax_rates ) );
            $max_price += WC_Tax::get_tax_total( WC_Tax::calc_exclusive_tax( $max_price, $tax_rates ) );
        }
    }

    $min_price = apply_filters( 'woocommerce_price_filter_widget_min_amount', floor( $min_price / $step ) * $step );
    $max_price = apply_filters( 'woocommerce_price_filter_widget_max_amount', ceil( $max_price / $step ) * $step );

    // If both min and max are equal, we don't need a slider.
    if ( $min_price === $max_price ) {
        return;
    }

    $current_min_price = isset( $_GET['min_price'] ) ? floor( floatval( wp_unslash($_GET['min_price'])) / $step ) * $step : $min_price;//phpcs:disable WordPress.Security.NonceVerification.Recommended
    $current_max_price = isset( $_GET['max_price'] ) ? ceil( floatval( wp_unslash($_GET['max_price'])) / $step ) * $step : $max_price;//phpcs:disable WordPress.Security.NonceVerification.Recommended

    if ( '' === get_option( 'permalink_structure' ) ) {
        $form_action = remove_query_arg( array( 'page', 'paged', 'product-page' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
    } else {
        $form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( trailingslashit( $wp->request ) ) );
    }
    //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
	echo '<div class="filter-item">'.$title; 
    wc_get_template(
        'content-widget-price-filter.php',
        array(
            'form_action'       => $form_action,
            'step'              => $step,
            'min_price'         => $min_price,
            'max_price'         => $max_price,
            'current_min_price' => $current_min_price,
            'current_max_price' => $current_max_price,
        )
    );	
    echo '</div>';
?>