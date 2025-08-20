<?php

    $icn = thepack_icon_svg($settings['icon']);
    $link = thepack_get_that_link($settings['url']);
    $link = $icn ? '<a class="tpbtn tbtr tp-dinflex"' . $link . '>'.$icn.'</a>' : '';
    $img = thepack_ft_images($settings['img']['id'],'full');
?>
<div class="tp-service-hover-bg tp-no-overflow tp-pos-rel">
    <div class="bg tbtr"><?php echo $img;?></div>
    <div class="tp-content tp-d-flex tp-pos-rel">
        <div class="tp-title tbtr">
            <?php echo thepack_build_html($settings['pre'],'span','pre'); ?>
            <?php echo thepack_build_html($settings['ttl'],'h3','title'); ?>
        </div>
        <div class="tp-desc tp-d-flex">
            <?php echo thepack_build_html($settings['desc'],'span','desc').$link; ?>
        </div>        
    </div>   
</div>