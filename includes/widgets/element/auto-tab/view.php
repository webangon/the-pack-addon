<?php
    $nav = $main = '';
    foreach ($settings['tabs'] as $a) {
        if($a['type']=='text'){
            $out = $a['cnt'];
        } elseif ( $a['type']=='template' ){
            $out = $this->render_template($a['tmpl']);
        } else {
            $out = wp_get_attachment_image($a['img']['id'], 'full');
        }
        $nav.='<div class="swiper-slide"><span>'.$a['ttl'].'</span></div>';
        $main.='<div class="swiper-slide">'.$out.'</div>';
    }
    $slider_options = [
        'item' => $settings['item']['size'],
        'item_tab' => $settings['item_tab']['size'],
        'speed' => $settings['speed']['size'],
        'space' => $settings['space']['size'],
        'center' => ('yes' === $settings['center']),
        'auto' => ('yes' === $settings['auto']),
    ];
    $previkn = $settings['picon']['value'] ? '<div class="khbprnx khbnxt"><i class="' . $settings['picon']['value'] . '"></i></div>' : '';
    $nextikn = $settings['nicon']['value'] ? '<div class="khbprnx khbprev"><i class="' . $settings['nicon']['value'] . '"></i></div>' : '';
    $arrow = $settings['arrow'] ? '<div class="tp-arrow">' . $previkn . $nextikn . '</div>' : '';

?>

<?php echo '<div class="the-pack-sync auto-tab" data-xld =\'' . wp_json_encode($slider_options) . '\'>'; ?>
    <div class="swiper swiper-sync">
        <div class="swiper-wrapper">
            <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            <?php echo the_pack_html_escaped($nav);?> 
        </div> 
    </div>    
    <div class="swiper swiper-default">
        <div class="swiper-wrapper">
            <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            <?php echo the_pack_html_escaped($main);?>
        </div>
        <?php //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        <?php echo the_pack_html_escaped($arrow); ?>
    </div>
</div>