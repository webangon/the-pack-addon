<?php
    if($settings['tmpl']=='icon'){
        $prev = the_pack_render_icon($settings['previ']);
        $next = the_pack_render_icon($settings['nexti']);
    } else {
        $prev = $settings['prevt'];
        $next = $settings['nextt'];
    }
?>
<div data-slider="<?php echo esc_attr($settings['cls']);?>" class="tp-swiper-arrow tp-d-flex">
    <span class="prev tp-d-flex tbtr"><?php echo $prev;?></span>
    <span class="next tp-d-flex tbtr"><?php echo $next;?></span>
</div>
