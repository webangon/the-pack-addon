<?php

if ( $settings['disp']=='slide' ){
    $parent_cls = 'tpswiper tp-woo-loop-1 swiper woocommerce';
    $main_cls = 'swiper-wrapper tp-product-catalog';
    $inclass = 'swiper-slide';
    $slider_options = [
        'item' => $settings['item']['size'],
        'item_tab' => $settings['item_tab']['size'],
        'speed' => $settings['speed']['size'],
        'space' => $settings['space']['size'],
        'auto' => ('yes' === $settings['auto']),
        'center' => ('yes' === $settings['center']),
    ];	

    $previkn = $settings['picon']['value'] ? '<div class="khbprnx khbnxt">'.the_pack_render_icon($settings['picon']).'</div>' : '';
    $nextikn = $settings['nicon']['value'] ? '<div class="khbprnx khbprev">'.the_pack_render_icon($settings['nicon']).'</div>' : '';
    $nav = $settings['arrow'] ? '<div class="tp-arrow">' . $previkn . $nextikn . '</div>' : '';
    $dot = $settings['dot'] ? '<div class="swiper-pagination"></div>' : '';

} else { 
    //
    $mason_grid = $settings['eq_ht'] ? ' tp-equal-height' : ' masonwrp masonon';
    $parent_cls = 'tp-woo-loop-1 woocommerce';
    $main_cls = 'tpoverflow tp-product-catalog'.$mason_grid;
    $inclass = 'tp-product-1';
    $slider_options = [];
    $nav = $dot = '';
}  

$wp_query = new \WP_Query( ['post__in' => $id,'post_type' => 'any'] );
if ($wp_query->have_posts()){
    echo '<div data-xld =\'' . wp_json_encode($slider_options) . '\' class="' . esc_attr($parent_cls) . '">';
    echo '<div class="' . esc_attr($main_cls) . '">';    
    while ( $wp_query->have_posts() ) {
        $wp_query->the_post();
        include THE_PACK_PLUGIN_DIR . 'includes/woocommerce/custom-loop.php';
    }   
    echo '</div> <!--$parent_cls-->';
    echo thepack_build_html($nav . $dot);//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
    echo '</div> <!--$main_cls-->';    
}
?>