<?php
global $product;
if ( empty( $product ) ) {
	return;
}

add_filter( 'woocommerce_product_tabs',function( $array ) use ( $settings ) {
    
        if ( ! $settings ) {
            return;
        }            
        unset( $array['description'] );
        unset( $array['additional_information'] );
        unset( $array['reviews'] );
        return $array;

    } 
);
 
if ($settings['hide_heading']){

    add_filter( 'woocommerce_product_description_heading', '__return_null' );

    add_filter( 'woocommerce_product_additional_information_heading', '__return_null' );

}

$product_tabs = apply_filters( 'woocommerce_product_tabs', [] );
foreach ($settings['items'] as $a) {

    $product_tabs[ $a['callback'] ] = array(
        'title'     => $a['lbl'],
        'callback'  => $a['callback'],
        'icon'  => $a['icn'],
        'template'  => $a['template']
    );

}

$no_attribute = $product->get_attributes() ? '' : 'no-attribute';
$class = $settings['tbstyle'].' '.$no_attribute;
?>
<div class="product-tab tp-tab tp-tab-1 <?php echo thepack_build_html($class);//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped?>">
    <ul class="tab-area">
        <?php
            foreach ($product_tabs as $tab) {
                $icon = the_pack_render_icon($tab['icon']);
                echo '<li class="'.$tab['callback'].'">'.$icon.'&nbsp;'.$tab['title'].'</li>';//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
            }
        ?>
    </ul>
    <div class="tab-wrap">
        <?php
            foreach ($product_tabs as $key => $tab) {
                if ($tab['callback']=='template'){
                    echo '<div class="tab-content">'.do_shortcode('[THEPACK_INSERT_TPL id="' . $tab['template'] . '"]').'</div>';
                } else {
                    echo '<div class="tab-content">';?>
                    <?php call_user_func($tab['callback'],$settings);?>
                    <?php echo '</div>';
                }
            }
        ?>        
    </div>
</div>


