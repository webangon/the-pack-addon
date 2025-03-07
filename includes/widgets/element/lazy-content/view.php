<?php
if($settings['type']=='img'){
    $img_src = wp_get_attachment_image_url( $settings['img']['id'], 'full' ); 
    echo '<img class="lazyload" data-src="'.$img_src.'" alt="Mountain" />';
} else {
    if ($settings['iframe']) {
        echo '<div class="tp-respnsiveframe"><iframe data-src="'.$settings['iframe'].'" class="lazyload" frameborder="0" allowfullscreen></iframe></div>';
    }
}?>